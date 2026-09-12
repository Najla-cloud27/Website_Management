<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StokRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_id' => ['required', 'exists:barangs,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'barang_id.required' => 'Barang wajib dipilih.',
            'barang_id.exists' => 'Barang tidak ditemukan.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'tanggal.required' => 'Tanggal wajib diisi.',
        ];
    }
}