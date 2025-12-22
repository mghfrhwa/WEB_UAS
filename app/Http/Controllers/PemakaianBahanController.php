<?php

namespace App\Http\Controllers;

use App\Models\PemakaianBahan;
use App\Models\Bahan;
use Illuminate\Http\Request;

class PemakaianBahanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required',
            'bahan_id' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);

        PemakaianBahan::create([
            'pesanan_id' => $request->pesanan_id,
            'bahan_id' => $request->bahan_id,
            'jumlah' => $request->jumlah,
            'tanggal_pakai' => now()
        ]);

        // Kurangi stok
        $bahan = Bahan::find($request->bahan_id);
        $bahan->stok -= $request->jumlah;
        $bahan->save();

        return back()->with('success', 'Bahan dipakai & stok diperbarui');
    }
}

