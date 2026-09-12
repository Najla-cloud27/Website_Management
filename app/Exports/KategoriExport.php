<?php

namespace App\Exports;

use App\Exports\Concerns\StylesSheetExport;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class KategoriExport implements FromView, WithTitle
{
    use StylesSheetExport;

    public function view(): View
    {
        $categories = Category::withCount('barangs')->orderBy('nama_kategori')->get();

        $rows = $categories->map(fn ($k, $i) => [
            $i + 1,
            $k->nama_kategori,
            $k->deskripsi ?? '-',
            $k->barangs_count,
        ])->toArray();

        return view('exports.excel.table', [
            'judul' => 'LAPORAN KATEGORI BARANG',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Nama Kategori', 'Deskripsi', 'Jumlah Barang'],
            'rows' => $rows,
        ]);
    }

    public function title(): string
    {
        return 'Kategori';
    }
}