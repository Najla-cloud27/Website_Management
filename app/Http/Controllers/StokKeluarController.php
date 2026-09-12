<?php

namespace App\Http\Controllers;

use App\Http\Requests\StokRequest;
use App\Models\Barang;
use App\Models\StokTransaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StokKeluarController extends Controller
{
    public function index(): View
    {
        $transaksis = StokTransaksi::with('barang', 'user')
            ->where('jenis', 'keluar')
            ->latest()
            ->paginate(10);

        return view('stok.keluar.index', compact('transaksis'));
    }

    public function create(): View
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('stok.keluar.create', compact('barangs'));
    }

    public function store(StokRequest $request): RedirectResponse
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data) {
                $barang = Barang::lockForUpdate()->findOrFail($data['barang_id']);

                if ($barang->stok < $data['jumlah']) {
                    throw ValidationException::withMessages([
                        'jumlah' => 'Stok tidak mencukupi. Stok saat ini: '.$barang->stok.' '.$barang->satuan.'.',
                    ]);
                }

                $barang->decrement('stok', $data['jumlah']);

                StokTransaksi::create([
                    'barang_id' => $barang->id,
                    'jenis' => 'keluar',
                    'jumlah' => $data['jumlah'],
                    'tanggal' => $data['tanggal'],
                    'keterangan' => $data['keterangan'] ?? null,
                    'user_id' => auth()->id(),
                ]);
            });
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }

        return redirect()->route('stok.keluar.index')
            ->with('success', 'Stok keluar berhasil dicatat dan saldo barang berkurang.');
    }
}