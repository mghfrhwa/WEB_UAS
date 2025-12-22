<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemakaianBahan extends Model
{
    protected $table = 'pemakaian_bahan';

    protected $fillable = [
        'pesanan_id', 'bahan_id', 'jumlah', 'tanggal_pakai'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'bahan_id');
    }
}

