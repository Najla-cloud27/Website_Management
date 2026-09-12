<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokTransaksi extends Model
{
    protected $table = 'stok_transaksis';

    protected $fillable = [
        'barang_id',
        'jenis',
        'jumlah',
        'tanggal',
        'keterangan',
        'user_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}