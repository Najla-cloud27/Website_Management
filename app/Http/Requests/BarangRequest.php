<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $barang = $this->route('barang');

        return [
            'kode_barang' => ['required', 'string', 'max:50', 'unique:barangs,kode_barang,'.($barang?->id ?? 'NULL')],
            'nama_barang' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'stok.required' => 'Stok awal wajib diisi.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'harga.required' => 'Harga wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
        ];
    }
}