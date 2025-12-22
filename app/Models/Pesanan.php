<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'nama_pesanan', 'deskripsi', 'status', 'biaya_jasa', 'total_biaya', 'tanggal_mulai',
        'tanggal_selesai', 'kode_pesanan'
    ];

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

