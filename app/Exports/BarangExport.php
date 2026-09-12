<?php

namespace App\Exports;

use App\Exports\Concerns\StylesSheetExport;
use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class BarangExport implements FromView, WithTitle
{
    use StylesSheetExport;

    public function view(): View
    {
        $barangs = Barang::with('category', 'supplier')->orderBy('nama_barang')->get();

        $rows = $barangs->map(fn ($b, $i) => [
            $i + 1,
            $b->kode_barang,
            $b->nama_barang,
            $b->category?->nama_kategori ?? '-',
            $b->supplier?->nama_supplier ?? '-',
            $b->stok,
            $b->satuan,
            'Rp '.number_format($b->harga, 0, ',', '.'),
        ])->toArray();

        return view('exports.excel.table', [
            'judul' => 'LAPORAN MANAJEMEN BARANG',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Supplier', 'Stok', 'Satuan', 'Harga'],
            'rows' => $rows,
        ]);
    }

    public function title(): string
    {
        return 'Barang';
    }
}