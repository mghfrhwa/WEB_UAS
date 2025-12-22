<?php

namespace App\Http\Controllers;

use App\Models\PesananPengguna;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananPenggunaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Ambil data dari tabel penghubung
        $riwayat = $user->pesananYangDiikuti()
                        ->with('pesanan.progres') 
                        ->latest()
                        ->get();
        $allOrders = $riwayat->map(function ($item) {
            return $item->pesanan;
        })->filter();

        // 1. Pesanan Aktif 
        $activeOrders = $allOrders->filter(function ($order) {
            return $order->status !== 'Selesai';
        });

        // 2. Riwayat Pesanan 
        $historyOrders = $allOrders->filter(function ($order) {
            return $order->status === 'Selesai';
        });

        // Hitung Statistik 
        $totalOrders = $allOrders->count();
        $inProgressOrders = $allOrders->where('status', 'Proses')->count();
        $pendingOrders = $allOrders->where('status', 'Menunggu')->count();
        $completedOrders = $allOrders->where('status', 'Selesai')->count();

        $portfolioItems = collect([]); 

        return view('customer.dashboard', compact(
            'activeOrders', 'historyOrders', // <-- Variable baru dikirim ke view
            'totalOrders', 'inProgressOrders', 
            'pendingOrders', 'completedOrders', 'portfolioItems'
        ));
    }

    public function cekKode(Request $request)
    {
        // Cari pesanan berdasarkan kode
        $pesanan = Pesanan::with(['progres'])->where('kode_pesanan', $request->kode)->first();

        if (!$pesanan) {
            return back()->with('error', 'Kode pesanan tidak ditemukan');
        }

        // Cek apakah user sudah mengikuti pesanan ini
        $user = Auth::user();
        $exists = PesananPengguna::where('pengguna_id', $user->id)
                                 ->where('pesanan_id', $pesanan->id)
                                 ->exists();
        

        if (!$exists) {
            PesananPengguna::create([
                'pengguna_id' => $user->id,
                'pesanan_id' => $pesanan->id,
                'tanggal_gabung' => now()
            ]);
        }

        // Redirect ke halaman detail progres
        return view('customer.lihat-progres', compact('pesanan'));
    }

    public function show($kode)
    {
        // Menampilkan detail pesanan berdasarkan kode
        $pesanan = Pesanan::with(['progres']) 
                          ->where('kode_pesanan', $kode)
                          ->firstOrFail();

        return view('customer.lihat-progres', compact('pesanan'));
    }
}