@extends('layout.master')

@section('title', 'Edit Progres')

@section('content')

<div class="page-wrapper">
    <form action="{{ route('progres.update', $progres->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        {{-- Variable $title dikirim ke form untuk judul dinamis --}}
        @include('admin.progres.form', ['title' => 'Edit Data Progres'])
    </form>
</div>

@endsection