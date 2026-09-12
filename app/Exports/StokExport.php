<?php

namespace App\Exports;

use App\Exports\Concerns\StylesSheetExport;
use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class StokExport implements FromView, WithTitle
{
    use StylesSheetExport;

    public function view(): View
    {
        $barangs = Barang::with('category')->orderBy('nama_barang')->get();

        $rows = $barangs->map(function ($b, $i) {
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
        })->toArray();

        return view('exports.excel.table', [
            'judul' => 'LAPORAN MONITORING STOK',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Stok', 'Satuan', 'Status', 'Nilai Stok'],
            'rows' => $rows,
        ]);
    }

    public function title(): string
    {
        return 'Stok';
    }
}