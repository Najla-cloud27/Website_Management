<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // nama tabel yang digunaka ini
    protected $table = 'categories';

    // koloom yang boleh di isi melalui assigment
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
}
