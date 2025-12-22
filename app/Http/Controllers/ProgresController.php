<?php

namespace App\Http\Controllers;

use App\Models\Progres;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // [PENTING] Tambahkan ini untuk kelola file

class ProgresController extends Controller
{
    /**
     * Tampilkan semua progres (overview admin)
     */
    public function index()
    {
        $progres = Progres::with('pesanan')
            ->orderBy('tanggal_progres', 'desc')
            ->get();

        return view('admin.progres.index', compact('progres'));
    }

    /**
     * Tampilkan progres berdasarkan pesanan tertentu
     */
    public function listByPesanan($pesanan_id)
    {
        $pesanan = Pesanan::findOrFail($pesanan_id);

        $progres = Progres::where('pesanan_id', $pesanan_id)
            ->orderBy('tanggal_progres', 'desc')
            ->get();

        return view('admin.progres.index', compact('pesanan', 'progres'));
    }

    /**
     * Form tambah progres (berdasarkan pesanan)
     */
    public function create($pesanan_id)
    {
        $pesanan = Pesanan::findOrFail($pesanan_id);

        return view('admin.progres.create', compact('pesanan'));
    }

    /**
     * Simpan progres baru
     */
    public function store(Request $request)
    {
        // 1. Validasi input (termasuk foto)
        $validatedData = $request->validate([
            'pesanan_id'   => 'required|exists:pesanan,id',
            'tahap_status' => 'required|string',
            'catatan'      => 'nullable|string',
            'foto'         => 'nullable|image|max:2048', // Max 2MB
            'tanggal_progres' => 'required',
        ]);

        // 2. Handle Upload Foto
        if ($request->hasFile('foto')) {
            // Upload ke folder: storage/app/public/progres
            // hashName() akan menghasilkan nama file acak yang unik (misal: sah271.jpg)
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('progres', $filename, 'public');
            
            // Simpan nama file saja ke array data
            $validatedData['foto'] = $filename;
        }

        // 3. Simpan ke Database
        Progres::create($validatedData);

        // Jika rute anda menggunakan 'listByPesanan', arahkan kembali kesana
        // Tapi redirect back() sudah cukup aman
        return redirect()
            ->route('progres.listByPesanan', $request->pesanan_id)
            ->with('success', 'Progres berhasil ditambahkan');
    }

    /**
     * Form edit progres
     */
    public function edit($id)
    {
        $progres = Progres::with('pesanan')->findOrFail($id);

        return view('admin.progres.edit', compact('progres'));
    }

    /**
     * Update progres
     */
    public function update(Request $request, $id)
    {
        $progres = Progres::findOrFail($id);

        // 1. Validasi
        $validatedData = $request->validate([
            'tahap_status'    => 'required|string',
            'catatan'         => 'nullable|string',
            'foto'            => 'nullable|image|max:2048',
            'tanggal_progres' => 'required',
        ]);

        // 2. Cek apakah user ingin menghapus foto lama (via tombol Hapus Foto di form)
        if ($request->input('remove_photo') == '1') {
            if ($progres->foto) {
                Storage::disk('public')->delete('progres/' . $progres->foto);
            }
            $validatedData['foto'] = null;
        }

        // 3. Handle jika ada upload foto BARU
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada (biar server tidak penuh sampah)
            if ($progres->foto && Storage::disk('public')->exists('progres/' . $progres->foto)) {
                Storage::disk('public')->delete('progres/' . $progres->foto);
            }

            // Upload foto baru
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('progres', $filename, 'public');
            $validatedData['foto'] = $filename;
        }

        // 4. Update Database
        $progres->update($validatedData);

        return redirect()
            ->route('progres.listByPesanan', $progres->pesanan_id)
            ->with('success', 'Progres berhasil diperbarui');
    }

    /**
     * Hapus progres
     */
    public function destroy($id)
    {
        $progres = Progres::findOrFail($id);

        // 1. Hapus file fisik foto jika ada
        if ($progres->foto && Storage::disk('public')->exists('progres/' . $progres->foto)) {
            Storage::disk('public')->delete('progres/' . $progres->foto);
        }

        // 2. Hapus record database
        $progres->delete();

        return redirect()
            ->back()
            ->with('success', 'Progres berhasil dihapus');
    }
}