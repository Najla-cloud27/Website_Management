<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringStokController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $barangs = Barang::with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%{$search}%")
                        ->orWhere('kode_barang', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                $query->when($status === 'habis', fn ($q) => $q->where('stok', '=', 0))
                    ->when($status === 'menipis', fn ($q) => $q->whereBetween('stok', [1, 10]))
                    ->when($status === 'aman', fn ($q) => $q->where('stok', '>', 10));
            })
            ->orderBy('stok', 'asc')
            ->paginate(12)
            ->withQueryString();

        $totalBarang = Barang::count();
        $totalStok = Barang::sum('stok');
        $totalMenipis = Barang::whereBetween('stok', [1, 10])->count();
        $totalHabis = Barang::where('stok', '=', 0)->count();

        return view('stok.monitoring.index', compact('barangs', 'search', 'status', 'totalBarang', 'totalStok', 'totalMenipis', 'totalHabis'));
    }
}