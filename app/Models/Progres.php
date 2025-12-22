<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    protected $table = 'progres';

    protected $fillable = [
        'pesanan_id', 'catatan', 'foto', 'tahap_status', 'tanggal_progres'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}

