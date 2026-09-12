<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supplier = $this->route('supplier');

        return [
            'nama_supplier' => ['required', 'string', 'max:255', 'unique:suppliers,nama_supplier,'.($supplier?->id ?? 'NULL')],
            'perusahaan' => ['nullable', 'string', 'max:255'],
            'nomor_telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_supplier.required' => 'Nama supplier wajib diisi.',
            'nama_supplier.unique' => 'Nama supplier sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
        ];
    }
}