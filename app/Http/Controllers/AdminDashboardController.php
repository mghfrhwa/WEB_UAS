<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Bahan;
use App\Models\Katalog;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'menunggu'  => Pesanan::where('status', 'menunggu')->count(),
            'proses'    => Pesanan::where('status', 'proses')->count(),
            'selesai'   => Pesanan::where('status', 'selesai')->count(),
            'total'     => Pesanan::count(),
            'dp_bulan'  => Pesanan::where('status_pembayaran', 'dp')
                            ->whereMonth('updated_at', Carbon::now()->month)
                            ->sum('jumlah_dp'),
            'lunas_bulan' => Pesanan::where('status_pembayaran', 'lunas')
                            ->whereMonth('updated_at', Carbon::now()->month)
                            ->sum('harga_total'),
        ];

        $pesananTerbaru = Pesanan::orderByDesc('created_at')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'pesananTerbaru'));
    }
}