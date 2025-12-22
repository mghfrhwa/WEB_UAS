<?php

namespace App\Models;

// 1. HAPUS atau comment baris ini:
// use Illuminate\Database\Eloquent\Model;

// 2. TAMBAHKAN baris ini:
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 3. UBAH 'extends Model' menjadi 'extends Authenticatable'
class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama', 'email', 'kata_sandi', 'telepon', 'peran'
    ];

    // 4. PENTING: Beritahu Laravel kolom password kita namanya 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    public function pesananYangDiikuti()
    {
        return $this->hasMany(PesananPengguna::class, 'pengguna_id');
    }
}