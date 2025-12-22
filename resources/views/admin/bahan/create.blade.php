@extends('layout.master')

@section('title', 'Tambah Bahan')

@section('content')

<h2>Tambah Bahan</h2>

<form action="{{ route('bahan.store') }}" method="POST">
    @csrf

    <label>Nama Bahan:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="satuan" required><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" required><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" required><br><br>

    <label>Keterangan:</label><br>
    <textarea name="keterangan"></textarea><br><br>

    <button class="btn">Simpan</button>
    <a href="{{ route('bahan.index') }}" class="btn">Kembali</a>
</form>

@endsection
