@extends('layout.master')

@section('title', 'Tambah Progres')

@section('content')

<div class="page-wrapper">
    <form action="{{ route('progres.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">
        
        {{-- Variable $title dikirim ke form untuk judul dinamis --}}
        @include('admin.progres.form', ['title' => 'Tambah Progres Baru'])
    </form>
</div>

@endsection