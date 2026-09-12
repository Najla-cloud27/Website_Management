<?php

namespace App\Exports;

use App\Exports\Concerns\StylesSheetExport;
use App\Models\StokTransaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TransaksiExport implements FromView, WithTitle
{
    use StylesSheetExport;

    public function __construct(protected string $jenis = 'transaksi')
    {
    }

    public function view(): View
    {
        $query = StokTransaksi::with('barang', 'user');

        if (in_array($this->jenis, ['masuk', 'keluar'])) {
            $query->where('jenis', $this->jenis);
        }

        $transaksis = $query->orderBy('tanggal', 'desc')->get();

        $rows = $transaksis->map(fn ($t, $i) => [
            $i + 1,
            \Carbon\Carbon::parse($t->tanggal)->format('d M Y'),
            $t->barang?->kode_barang ?? '-',
            $t->barang?->nama_barang ?? '-',
            ucfirst($t->jenis),
            $t->jumlah,
            $t->barang?->satuan ?? '-',
            $t->keterangan ?? '-',
            $t->user?->name ?? '-',
        ])->toArray();

        $judul = match ($this->jenis) {
            'masuk' => 'LAPORAN STOK MASUK',
            'keluar' => 'LAPORAN STOK KELUAR',
            default => 'LAPORAN TRANSAKSI STOK',
        };

        return view('exports.excel.table', [
            'judul' => $judul,
            'tanggal' => now()->format('d M Y H:i'),
            'headers' => ['No', 'Tanggal', 'Kode Barang', 'Nama Barang', 'Jenis', 'Jumlah', 'Satuan', 'Keterangan', 'Petugas'],
            'rows' => $rows,
        ]);
    }

    public function title(): string
    {
        return match ($this->jenis) {
            'masuk' => 'Stok Masuk',
            'keluar' => 'Stok Keluar',
            default => 'Transaksi Stok',
        };
    }
}