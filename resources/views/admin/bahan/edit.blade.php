@extends('layout.master')

@section('title', 'Edit Bahan')

@section('content')

<h2>Edit Bahan</h2>

<form action="{{ route('bahan.update', $bahan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Bahan:</label><br>
    <input type="text" name="nama" value="{{ $bahan->nama }}" required><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="satuan" value="{{ $bahan->satuan }}" required><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" value="{{ $bahan->stok }}" required><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" value="{{ $bahan->harga }}" required><br><br>

    <label>Keterangan:</label><br>
    <textarea name="keterangan">{{ $bahan->keterangan }}</textarea><br><br>

    <button class="btn">Update</button>
    <a href="{{ route('bahan.index') }}" class="btn">Kembali</a>
</form>

@endsection
