<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Category;
use App\Models\StokTransaksi;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    protected function makeAdmin(): User
    {
        return User::factory()->admin()->create();
    }

    protected function makeUser(): User
    {
        return User::factory()->create();
    }

    protected function makeBarang(array $attributes = []): Barang
    {
        return Barang::create(array_merge([
            'kode_barang' => 'BRG-'.Str::upper(Str::random(6)),
            'nama_barang' => 'Barang Uji',
            'stok' => 10,
            'harga' => 150000,
            'satuan' => 'pcs',
        ], $attributes));
    }

    public function test_register_creates_user_with_role_user(): void
    {
        $this->post('/register', [
            'name' => 'Anggota Baru',
            'email' => 'anggota@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'anggota@example.com',
            'role' => 'user',
        ]);
    }

    public function test_admin_can_open_admin_dashboard(): void
    {
        $response = $this->actingAs($this->makeAdmin())->get('/dashboard');

        $response->assertOk()
            ->assertSee('Dashboard Admin')
            ->assertSee('Nilai Inventori');
    }

    public function test_user_gets_user_dashboard(): void
    {
        $response = $this->actingAs($this->makeUser())->get('/dashboard');

        $response->assertOk()
            ->assertSee('Total Stok')
            ->assertDontSee('Nilai Inventori');
    }

    public function test_user_cannot_open_admin_pages(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)->get('/users')->assertRedirect(route('dashboard'));
        $this->actingAs($user)->get('/laporan')->assertRedirect(route('dashboard'));
        $this->actingAs($user)->get('/stok/monitoring')->assertRedirect(route('dashboard'));
        $this->actingAs($user)->get('/export-pdf/barang')->assertRedirect(route('dashboard'));
        $this->actingAs($user)->get('/export-excel/barang')->assertRedirect(route('dashboard'));
    }

    public function test_admin_can_open_admin_pages(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)->get('/users')->assertOk();
        $this->actingAs($admin)->get('/laporan')->assertOk();
        $this->actingAs($admin)->get('/stok/monitoring')->assertOk()->assertSee('Monitoring Stok');
        $this->actingAs($admin)->get('/export-pdf/barang')->assertOk();
        $this->actingAs($admin)->get('/export-excel/barang')->assertOk();
    }

    public function test_user_cannot_create_supplier(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)->get('/supplier/create')->assertRedirect(route('dashboard'));

        $this->actingAs($user)->post('/supplier', [
            'nama_supplier' => 'Supplier Uji',
            'perusahaan' => 'PT Uji',
            'nomor_telepon' => '081234567890',
            'email' => 'supplier@example.com',
            'alamat' => 'Alamat uji',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('suppliers', ['nama_supplier' => 'Supplier Uji']);
    }

    public function test_user_can_view_suppliers_as_reference(): void
    {
        Supplier::create([
            'nama_supplier' => 'PT Sumber Jaya',
            'perusahaan' => 'PT Sumber Jaya',
            'nomor_telepon' => '081234567890',
        ]);

        $this->actingAs($this->makeUser())
            ->get('/supplier')
            ->assertOk()
            ->assertSee('PT Sumber Jaya')
            ->assertDontSee('Tambah Supplier');
    }

    public function test_admin_can_create_supplier(): void
    {
        $this->actingAs($this->makeAdmin())
            ->get('/supplier/create')
            ->assertOk();

        $this->actingAs($this->makeAdmin())
            ->post('/supplier', [
                'nama_supplier' => 'PT Maju Jaya',
                'perusahaan' => 'PT Maju Jaya',
                'nomor_telepon' => '082233445566',
                'email' => 'maju@example.com',
                'alamat' => 'Jl. Merdeka No. 1',
            ])->assertRedirect(route('supplier.index'));

        $this->assertDatabaseHas('suppliers', ['nama_supplier' => 'PT Maju Jaya']);
    }

    public function test_user_cannot_destroy_barang(): void
    {
        $barang = $this->makeBarang();

        $this->actingAs($this->makeUser())->delete("/barang/{$barang->id}")
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('barangs', ['id' => $barang->id]);
    }

    public function test_user_cannot_create_or_edit_category(): void
    {
        $category = Category::create([
            'nama_kategori' => 'Kategori Uji',
            'deskripsi' => 'Deskripsi uji',
        ]);

        $user = $this->makeUser();

        $this->actingAs($user)->get('/categories/create')->assertRedirect(route('dashboard'));
        $this->actingAs($user)->get("/categories/{$category->id}/edit")->assertRedirect(route('dashboard'));
        $this->actingAs($user)->delete("/categories/{$category->id}")->assertRedirect(route('dashboard'));
    }

    public function test_admin_can_manage_categories(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)->get('/categories/create')->assertOk();

        $this->actingAs($admin)->post('/categories', [
            'nama_kategori' => 'Elektronik',
            'deskripsi' => 'Barang elektronik',
        ])->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', ['nama_kategori' => 'Elektronik']);
    }

    public function test_stok_masuk_increases_stok(): void
    {
        $user = $this->makeUser();
        $barang = $this->makeBarang(['stok' => 10]);

        $this->actingAs($user)->post('/stok-masuk', [
            'barang_id' => $barang->id,
            'jumlah' => 5,
            'tanggal' => now()->toDateString(),
            'keterangan' => 'Pembelian baru',
        ])->assertRedirect(route('stok.masuk.index'));

        $this->assertDatabaseHas('barangs', ['id' => $barang->id, 'stok' => 15]);
        $this->assertDatabaseHas('stok_transaksis', [
            'barang_id' => $barang->id,
            'jenis' => 'masuk',
            'jumlah' => 5,
            'user_id' => $user->id,
        ]);
    }

    public function test_stok_keluar_decreases_stok(): void
    {
        $user = $this->makeUser();
        $barang = $this->makeBarang(['stok' => 10]);

        $this->actingAs($user)->post('/stok-keluar', [
            'barang_id' => $barang->id,
            'jumlah' => 4,
            'tanggal' => now()->toDateString(),
            'keterangan' => 'Penjualan',
        ])->assertRedirect(route('stok.keluar.index'));

        $this->assertDatabaseHas('barangs', ['id' => $barang->id, 'stok' => 6]);
        $this->assertDatabaseHas('stok_transaksis', [
            'barang_id' => $barang->id,
            'jenis' => 'keluar',
            'jumlah' => 4,
            'user_id' => $user->id,
        ]);
    }

    public function test_stok_keluar_rejected_when_insufficient_stok(): void
    {
        $user = $this->makeUser();
        $barang = $this->makeBarang(['stok' => 3]);

        $response = $this->actingAs($user)->post('/stok-keluar', [
            'barang_id' => $barang->id,
            'jumlah' => 10,
            'tanggal' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('jumlah');
        $this->assertDatabaseHas('barangs', ['id' => $barang->id, 'stok' => 3]);
        $this->assertDatabaseCount('stok_transaksis', 0);
    }

    public function test_admin_can_manage_users(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)->post('/users', [
            'name' => 'Karyawan Baru',
            'email' => 'karyawan@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'karyawan@example.com',
            'role' => 'user',
        ]);
    }

    public function test_barang_report_data_is_built(): void
    {
        $this->makeBarang(['stok' => 5]);
        $this->makeBarang(['stok' => 0]);

        $admin = $this->makeAdmin();

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertOk()
            ->assertSee('2') // total barang
            ->assertSee('Habis')
            ->assertSee('Menipis');
    }

    public function test_supplier_show_counts_barangs(): void
    {
        $supplier = Supplier::create([
            'nama_supplier' => 'PT Sumber Jaya',
            'nomor_telepon' => '081234567890',
        ]);

        $this->makeBarang(['supplier_id' => $supplier->id]);
        $this->makeBarang(['supplier_id' => $supplier->id]);

        $this->actingAs($this->makeAdmin())->get("/supplier/{$supplier->id}")
            ->assertOk()
            ->assertSee('2');
    }

    public function test_pdf_report_downloads_correctly(): void
    {
        $this->makeBarang();

        $this->actingAs($this->makeAdmin())
            ->get('/export-pdf/barang')
            ->assertOk();
    }
}