<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PesananSeeder extends Seeder
{
    public function run()
    {
        $statusBayar = ['lunas', 'dp', 'belum_bayar'];
        
        for ($i = 0; $i < 50; $i++) {
            $hargaTotal = rand(5, 50) * 100000; // Rp 500rb - 5jt
            $status = $statusBayar[array_rand($statusBayar)];
            
            $jumlahDp = 0;
            if ($status === 'lunas') {
                $jumlahDp = $hargaTotal;
            } elseif ($status === 'dp') {
                $jumlahDp = $hargaTotal * 0.5; // DP 50%
            }

            // Buat tanggal acak dalam 6 bulan terakhir
            $randomDate = Carbon::now()->subDays(rand(0, 180));

            Pesanan::create([
                'kode_pesanan'      => 'ORD-' . strtoupper(Str::random(5)),
                'nama_pesanan'      => 'Pesanan Custom Ke-' . ($i + 1),
                'harga_total'       => $hargaTotal,
                'jumlah_dp'         => $jumlahDp,
                'status_pembayaran' => $status,
                'status'            => 'proses', // Status produksi
                'created_at'        => $randomDate,
                'updated_at'        => $randomDate,
            ]);
        }
    }
}