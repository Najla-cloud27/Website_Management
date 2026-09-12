<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $barangs = Barang::with('category', 'supplier')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%{$search}%")
                        ->orWhere('kode_barang', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('barang.index', compact('barangs', 'search'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        return view('barang.create', compact('categories', 'suppliers'));
    }

    public function store(BarangRequest $request): RedirectResponse
    {
        Barang::create($request->validated());

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang): View
    {
        $barang->load('category', 'supplier');

        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang): View
    {
        $categories = Category::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        return view('barang.edit', compact('barang', 'categories', 'suppliers'));
    }

    public function update(BarangRequest $request, Barang $barang): RedirectResponse
    {
        $barang->update($request->validated());

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang): RedirectResponse
    {
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}