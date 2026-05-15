<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemakaianBahan;
use App\Models\Pesanan;
use App\Models\Bahan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        // Mengambil pesanan dengan pagination 10 data per halaman
        $pesanan = Pesanan::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $bahan = Bahan::all();
        return view('admin.pesanan.create', compact('bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pesanan' => 'required',
        ]);

        // Tanggal yang diinput di sini adalah PERKIRAAN awal
        $pesanan = Pesanan::create([
            'nama_pesanan' => $request->nama_pesanan,
            'deskripsi' => $request->deskripsi,
            'status' => 'menunggu',
            'biaya_jasa' => $request->biaya_jasa ?? 0,
            'tanggal_mulai' => $request->tanggal_mulai, // Perkiraan dari form
            'tanggal_selesai' => $request->tanggal_selesai, // Perkiraan dari form
            'kode_pesanan' => 'PSN-' . strtoupper(Str::random(6)),
        ]);

        $total_bahan = 0;

        // SIMPAN PEMAKAIAN BAHAN
        if ($request->bahan_id) {
            foreach ($request->bahan_id as $i => $bahan_id) {

                $jumlah = $request->jumlah[$i];

                if ($jumlah > 0) {
                    $bahan = Bahan::findOrFail($bahan_id);

                    PemakaianBahan::create([
                        'pesanan_id' => $pesanan->id,
                        'bahan_id' => $bahan_id,
                        'jumlah' => $jumlah,
                        'harga' => $bahan->harga,
                        'tanggal_pakai' => now()
                    ]);

                    // Kurangi stok
                    $bahan->stok -= $jumlah;
                    $bahan->save();

                    $total_bahan += $jumlah * $bahan->harga;
                }
            }
        }

        // TOTAL BIAYA = BAHAN + JASA
        $pesanan->total_biaya = $total_bahan + $pesanan->biaya_jasa;
        $pesanan->save();

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan & bahan berhasil disimpan');
    }



    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::with('bahanDipakai.bahan')->findOrFail($id);
        $bahan = Bahan::all();

        return view('admin.pesanan.edit', compact('pesanan','bahan'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $oldStatus = $pesanan->status; // Ambil status LAMA sebelum diupdate

        // Data yang akan diupdate dari form (dianggap perkiraan/input manual)
        $updateData = [
            'nama_pesanan' => $request->nama_pesanan,
            'deskripsi'    => $request->deskripsi,
            'status'       => $request->status,
            'biaya_jasa'   => $request->biaya_jasa ?? 0,
            // Perkiraan dari form dipertahankan jika tidak ada trigger otomatis
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ];

        // 1. LOGIKA FLEKSIBEL TANGGAL MULAI (Aktual)
        if ($request->status === 'proses' && $oldStatus !== 'proses' && empty($pesanan->tanggal_mulai)) {
            // Jika status baru 'proses', status lama BUKAN 'proses', dan Tgl Mulai masih KOSONG
            $updateData['tanggal_mulai'] = now(); // Catat tanggal mulai AKTUAL
        }

        // 2. LOGIKA FLEKSIBEL TANGGAL SELESAI (Aktual)
        if ($request->status === 'selesai' && $oldStatus !== 'selesai' && empty($pesanan->tanggal_selesai)) {
            // Jika status baru 'selesai', status lama BUKAN 'selesai', dan Tgl Selesai masih KOSONG
            $updateData['tanggal_selesai'] = now(); // Catat tanggal selesai AKTUAL
        }

        // Jika Admin menghapus tanggal perkiraan saat status belum mencapai tahap itu, biarkan null
        if (empty($request->tanggal_mulai) && $request->status === 'menunggu') {
            $updateData['tanggal_mulai'] = null;
        }
        if (empty($request->tanggal_selesai) && $request->status !== 'selesai') {
            $updateData['tanggal_selesai'] = null;
        }

        // Update data pesanan
        $pesanan->update($updateData);

        // Proses bahan tambahan (jika ada input baru)
        if ($request->bahan_id && $request->jumlah) {
            foreach ($request->bahan_id as $i => $bahan_id) {

                $jumlah = (int) $request->jumlah[$i];
                if ($jumlah <= 0) continue;

                $bahan = Bahan::findOrFail($bahan_id);

                PemakaianBahan::create([
                    'pesanan_id' => $pesanan->id,
                    'bahan_id'   => $bahan->id,
                    'jumlah'     => $jumlah,
                    'tanggal_pakai' => now(),
                ]);

                $bahan->stok -= $jumlah;
                $bahan->save();
            }
        }

        // HITUNG ULANG TOTAL BIAYA
        $totalBahan = PemakaianBahan::where('pesanan_id', $pesanan->id)
            ->join('bahan', 'pemakaian_bahan.bahan_id', '=', 'bahan.id')
            ->sum(DB::raw('pemakaian_bahan.jumlah * bahan.harga'));

        $pesanan->total_biaya = $totalBahan + ($pesanan->biaya_jasa ?? 0);
        $pesanan->save();

        return redirect()
            ->route('pesanan.show', $pesanan->id)
            ->with('success', 'Pesanan & total biaya berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pesanan::destroy($id);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }

    public function riwayat()
    {
        $pesanan = Pesanan::where('status', 'Selesai')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('admin.pesanan.riwayat', compact('pesanan'));
    }
}
