<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';

    protected $fillable = [
        'nama', 'satuan', 'stok', 'harga', 'keterangan'
    ];

    public function pemakaian()
    {
        return $this->hasMany(PemakaianBahan::class, 'bahan_id');
    }
}

