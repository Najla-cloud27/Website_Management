<?php

namespace App\Exports;

use App\Exports\Concerns\StylesSheetExport;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class SupplierExport implements FromView, WithTitle
{
    use StylesSheetExport;

    public function view(): View
    {
        $suppliers = Supplier::withCount('barangs')->orderBy('nama_supplier')->get();

        $rows = $suppliers->map(fn ($s, $i) => [
            $i + 1,
            $s->nama_supplier,
            $s->perusahaan ?? '-',
            $s->nomor_telepon ?? '-',
            $s->email ?? '-',
            $s->alamat ?? '-',
            $s->barangs_count,
        ])->toArray();

        return view('exports.excel.table', [
            'judul' => 'LAPORAN DATA SUPPLIER',
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Nama Supplier', 'Perusahaan', 'Telepon', 'Email', 'Alamat', 'Jumlah Barang'],
            'rows' => $rows,
        ]);
    }

    public function title(): string
    {
        return 'Supplier';
    }
}