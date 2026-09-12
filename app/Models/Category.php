<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // nama tabel yang digunaka ini
    protected $table = 'categories';

    // koloom yang boleh di isi melalui assigment
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'category_id');
    }
}
