<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    // app/Models/Pesanan.php
    protected $fillable = [
        'nama_pesanan', 'deskripsi', 'status',
        'tanggal_mulai', 'tanggal_selesai', 'kode_pesanan',
        'harga_total', 'jumlah_dp', 'status_pembayaran', // tambahkan ini
    ];

    protected $casts = [
        'harga_total' => 'decimal:2',
        'jumlah_dp'   => 'decimal:2',
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Accessor: sisa pembayaran
    public function getSisaBayarAttribute(): float
    {
        return (float)$this->harga_total - (float)$this->jumlah_dp;
    }

    public function progres()
    {
        return $this->hasMany(Progres::class, 'pesanan_id');
    }

    public function bahanDipakai()
    {
        return $this->hasMany(PemakaianBahan::class, 'pesanan_id');
    }

    public function diikutiOleh()
    {
        return $this->hasMany(PesananPengguna::class, 'pesanan_id');
    }
}

