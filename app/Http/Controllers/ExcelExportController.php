<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Exports\KategoriExport;
use App\Exports\StokExport;
use App\Exports\SupplierExport;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelExportController extends Controller
{
    public function export(string $jenis): BinaryFileResponse
    {
        [$export, $nama] = $this->resolve($jenis);

        return Excel::download($export, $nama.'-'.now()->format('Y-m-d').'.xlsx');
    }

    protected function resolve(string $jenis): array
    {
        return match ($jenis) {
            'barang' => [new BarangExport, 'Laporan-Barang'],
            'kategori' => [new KategoriExport, 'Laporan-Kategori'],
            'supplier' => [new SupplierExport, 'Laporan-Supplier'],
            'stok' => [new StokExport, 'Laporan-Stok'],
            'transaksi' => [new TransaksiExport, 'Laporan-Transaksi-Stok'],
            'masuk' => [new TransaksiExport('masuk'), 'Laporan-Stok-Masuk'],
            'keluar' => [new TransaksiExport('keluar'), 'Laporan-Stok-Keluar'],
            default => abort(404),
        };
    }
}