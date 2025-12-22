<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus file

class KatalogController extends Controller
{
    // Halaman Katalog untuk Customer
    public function publicIndex() {
        $katalog = Katalog::all();
        return view('customer.katalog', compact('katalog'));
    }

    // Halaman Katalog untuk Admin
    public function index() {
        $katalog = Katalog::all();
        return view('admin.katalog.index', compact('katalog'));
    }

    // Simpan Data Baru + Upload Foto
    public function store(Request $r) {
        // 1. Validasi
        $validatedData = $r->validate([
            'judul'     => 'required',
            'deskripsi' => 'nullable',
            'harga'     => 'required|numeric',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Cek apakah ada file foto yang diupload
        if ($r->hasFile('foto')) {
            // Simpan ke storage/app/public/katalog-img
            $path = $r->file('foto')->store('katalog-img', 'public');
            $validatedData['foto'] = $path;
        }

        // 3. Simpan ke Database
        Katalog::create($validatedData);

        return back()->with('success', 'Katalog berhasil ditambahkan');
    }

    // Update Data + Ganti Foto
    public function update(Request $r, $id) {
        $item = Katalog::findOrFail($id);

        // 1. Validasi
        $validatedData = $r->validate([
            'judul'     => 'required',
            'deskripsi' => 'nullable',
            'harga'     => 'required|numeric',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Cek apakah ada foto baru
        if ($r->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($item->foto) {
                Storage::disk('public')->delete($item->foto);
            }

            // Upload foto baru
            $path = $r->file('foto')->store('katalog-img', 'public');
            $validatedData['foto'] = $path;
        }

        // 3. Update data di database
        $item->update($validatedData);

        return back()->with('success', 'Katalog berhasil diperbarui');
    }

    // Hapus Data + Hapus File Foto
    public function destroy($id) {
        $item = Katalog::findOrFail($id);

        // Hapus file foto dari penyimpanan fisik
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }

        // Hapus record dari database
        $item->delete();

        return back()->with('success', 'Katalog berhasil dihapus');
    }
}