<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\StokTransaksi;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfExportController extends Controller
{
    public function export(string $jenis): Response
    {
        $data = $this->resolve($jenis);

        $pdf = Pdf::loadView('exports.pdf.table', $data)
            ->setPaper('a4', 'landscape')
            ->setOption('isPhpEnabled', true);

        return $pdf->download($data['namaFile'].'-'.now()->format('Y-m-d').'.pdf');
    }

    protected function resolve(string $jenis): array
    {
        return match ($jenis) {
            'barang' => $this->barang(),
            'kategori' => $this->kategori(),
            'supplier' => $this->supplier(),
            'stok' => $this->stok(),
            'transaksi' => $this->transaksi(),
            'masuk' => $this->transaksi('masuk'),
            'keluar' => $this->transaksi('keluar'),
            default => abort(404),
        };
    }

    protected function barang(): array
    {
        $barangs = Barang::with('category', 'supplier')->orderBy('nama_barang')->get();

        return [
            'namaFile' => 'Laporan-Barang',
            'judul' => 'LAPORAN MANAJEMEN BARANG',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Supplier', 'Stok', 'Satuan', 'Harga'],
            'rows' => $barangs->map(fn ($b, $i) => [
                $i + 1,
                $b->kode_barang,
                $b->nama_barang,
                $b->category?->nama_kategori ?? '-',
                $b->supplier?->nama_supplier ?? '-',
                $b->stok,
                $b->satuan,
                'Rp '.number_format($b->harga, 0, ',', '.'),
            ])->toArray(),
        ];
    }

    protected function kategori(): array
    {
        $categories = Category::withCount('barangs')->orderBy('nama_kategori')->get();

        return [
            'namaFile' => 'Laporan-Kategori',
            'judul' => 'LAPORAN KATEGORI BARANG',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Nama Kategori', 'Deskripsi', 'Jumlah Barang'],
            'rows' => $categories->map(fn ($k, $i) => [
                $i + 1,
                $k->nama_kategori,
                $k->deskripsi ?? '-',
                $k->barangs_count,
            ])->toArray(),
        ];
    }

    protected function supplier(): array
    {
        $suppliers = Supplier::withCount('barangs')->orderBy('nama_supplier')->get();

        return [
            'namaFile' => 'Laporan-Supplier',
            'judul' => 'LAPORAN DATA SUPPLIER',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Nama Supplier', 'Perusahaan', 'Telepon', 'Email', 'Alamat', 'Jumlah Barang'],
            'rows' => $suppliers->map(fn ($s, $i) => [
                $i + 1,
                $s->nama_supplier,
                $s->perusahaan ?? '-',
                $s->nomor_telepon ?? '-',
                $s->email ?? '-',
                $s->alamat ?? '-',
                $s->barangs_count,
            ])->toArray(),
        ];
    }

    protected function stok(): array
    {
        $barangs = Barang::with('category')->orderBy('nama_barang')->get();

        return [
            'namaFile' => 'Laporan-Stok',
            'judul' => 'LAPORAN MONITORING STOK',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Stok', 'Satuan', 'Status', 'Nilai Stok'],
            'rows' => $barangs->map(function ($b, $i) {
                $status = $b->stok = 0 ? 'Habis' : ($b->stok <= 10 ? 'Menipis' : 'Aman');

                return [
                    $i + 1,
                    $b->kode_barang,
                    $b->nama_barang,
                    $b->category?->nama_kategori ?? '-',
                    $b->stok,
                    $b->satuan,
                    $status,
                    'Rp '.number_format($b->harga * $b->stok, 0, ',', '.'),
                ];
            })->toArray(),
        ];
    }

    protected function transaksi(string $jenis = 'transaksi'): array
    {
        $query = StokTransaksi::with('barang', 'user');

        if (in_array($jenis, ['masuk', 'keluar'])) {
            $query->where('jenis', $jenis);
        }

        $transaksis = $query->orderBy('tanggal', 'desc')->get();

        $judul = match ($jenis) {
            'masuk' => 'LAPORAN STOK MASUK',
            'keluar' => 'LAPORAN STOK KELUAR',
            default => 'LAPORAN TRANSAKSI STOK',
        };

        $namaFile = match ($jenis) {
            'masuk' => 'Laporan-Stok-Masuk',
            'keluar' => 'Laporan-Stok-Keluar',
            default => 'Laporan-Transaksi-Stok',
        };

        return [
            'namaFile' => $namaFile,
            'judul' => $judul,
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Tanggal', 'Kode Barang', 'Nama Barang', 'Jenis', 'Jumlah', 'Satuan', 'Keterangan', 'Petugas'],
            'rows' => $transaksis->map(fn ($t, $i) => [
                $i + 1,
                \Carbon\Carbon::parse($t->tanggal)->format('d M Y'),
                $t->barang?->kode_barang ?? '-',
                $t->barang?->nama_barang ?? '-',
                ucfirst($t->jenis),
                $t->jumlah,
                $t->barang?->satuan ?? '-',
                $t->keterangan ?? '-',
                $t->user?->name ?? '-',
            ])->toArray(),
        ];
    }
}