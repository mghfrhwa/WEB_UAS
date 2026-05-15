<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index() {
        $bahan = Bahan::paginate(10);
        return view('admin.bahan.index', compact('bahan'));
    }

    public function create() {
        return view('admin.bahan.create');
    }

    public function store(Request $request) {
        Bahan::create($request->all());
        return redirect()->route('bahan.index')->with('success', 'Bahan ditambahkan');
    }

    public function edit($id) {
        $bahan = Bahan::findOrFail($id);
        return view('admin.bahan.edit', compact('bahan'));
    }

    public function update(Request $request, $id) {
        $bahan = Bahan::findOrFail($id);
        $bahan->update($request->all());
        return redirect()->route('bahan.index')->with('success', 'Bahan diperbarui');
    }

    public function destroy($id) {
        Bahan::destroy($id);
        return redirect()->route('bahan.index')->with('success', 'Bahan dihapus');
    }
}
