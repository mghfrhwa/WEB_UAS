<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananPengguna extends Model
{
    // Nama tabel di database (pastikan sesuai)
    protected $table = 'pesanan_pengguna';

    protected $fillable = [
        'pengguna_id', 
        'pesanan_id', 
        'tanggal_gabung'
    ];

    /**
     * Relasi ke model Pesanan.
     * PENTING: Tanpa ini, $item->pesanan di controller akan error/null.
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    /**
     * Relasi ke model Pengguna (Opsional, tapi bagus untuk kelengkapan).
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}