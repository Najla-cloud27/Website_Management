<?php

namespace App\Http\Controllers;

use App\Http\Requests\StokRequest;
use App\Models\Barang;
use App\Models\StokTransaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StokMasukController extends Controller
{
    public function index(): View
    {
        $transaksis = StokTransaksi::with('barang', 'user')
            ->where('jenis', 'masuk')
            ->latest()
            ->paginate(10);

        return view('stok.masuk.index', compact('transaksis'));
    }

    public function create(): View
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('stok.masuk.create', compact('barangs'));
    }

    public function store(StokRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $barang = Barang::lockForUpdate()->findOrFail($data['barang_id']);
            $barang->increment('stok', $data['jumlah']);

            StokTransaksi::create([
                'barang_id' => $barang->id,
                'jenis' => 'masuk',
                'jumlah' => $data['jumlah'],
                'tanggal' => $data['tanggal'],
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => auth()->id(),
            ]);
        });

        return redirect()->route('stok.masuk.index')
            ->with('success', 'Stok masuk berhasil dicatat dan saldo barang bertambah.');
    }
}