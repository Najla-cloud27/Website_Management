<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\StokTransaksi;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private const STOK_MINIMUM = 10;

    public function index(): View
    {
        return auth()->user()->isAdmin() ? $this->adminDashboard() : $this->userDashboard();
    }

    protected function adminDashboard(): View
    {
        $totalBarang = Barang::count();
        $totalKategori = Category::count();
        $totalSupplier = Supplier::count();
        $totalUser = User::count();
        $totalStok = (int) Barang::sum('stok');
        $stokMenipis = Barang::whereBetween('stok', [1, self::STOK_MINIMUM])->count();
        $stokHabis = Barang::where('stok', 0)->count();
        $nilaiInventori = (float) Barang::sum(DB::raw('stok * harga'));

        $chartTanggal = [];
        $chartMasuk = [];
        $chartKeluar = [];

        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartTanggal[] = now()->subDays($i)->format('d M');
            $chartMasuk[] = (int) StokTransaksi::where('jenis', 'masuk')
                ->whereDate('tanggal', $date)->sum('jumlah');
            $chartKeluar[] = (int) StokTransaksi::where('jenis', 'keluar')
                ->whereDate('tanggal', $date)->sum('jumlah');
        }

        $kategoriLabels = [];
        $kategoriCounts = [];
        foreach (Category::withCount('barangs')->orderBy('barangs_count', 'desc')->get() as $kategori) {
            $kategoriLabels[] = $kategori->nama_kategori;
            $kategoriCounts[] = $kategori->barangs_count;
        }

        $stokAman = $totalBarang - $stokMenipis - $stokHabis;

        $transaksiTerakhir = StokTransaksi::with('barang', 'user')
            ->latest()->take(8)->get();

        return view('dashboard-admin', compact(
            'totalBarang',
            'totalKategori',
            'totalSupplier',
            'totalUser',
            'totalStok',
            'stokMenipis',
            'stokHabis',
            'nilaiInventori',
            'chartTanggal',
            'chartMasuk',
            'chartKeluar',
            'kategoriLabels',
            'kategoriCounts',
            'stokAman',
            'transaksiTerakhir',
        ));
    }

    protected function userDashboard(): View
    {
        $totalBarang = Barang::count();
        $totalStok = (int) Barang::sum('stok');
        $stokMenipis = Barang::whereBetween('stok', [1, self::STOK_MINIMUM])->count();
        $transaksiTerakhir = StokTransaksi::with('barang', 'user')
            ->latest()->take(8)->get();

        return view('dashboard-user', compact(
            'totalBarang',
            'totalStok',
            'stokMenipis',
            'transaksiTerakhir',
        ));
    }
}