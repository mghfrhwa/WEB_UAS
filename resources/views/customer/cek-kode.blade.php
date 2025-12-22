@extends('layout.master')

@section('title', 'Lacak Pesanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fs-5"><i class="fas fa-search me-2"></i> Lacak Progress Pesanan</h4>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-qrcode fa-4x text-primary mb-3"></i>
                        <h3>Masukkan Kode Pesanan</h3>
                        <p class="text-muted">Gunakan kode yang Anda dapatkan untuk melacak progress proyek</p>
                    </div>
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('customer.cekKode') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kode Pesanan</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-hashtag text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" name="kode" 
                                       placeholder="Contoh: ORD-12345" 
                                       value="{{ old('kode') }}"
                                       required
                                       autofocus>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>
                                Kode pesanan biasanya tertera pada nota atau invoice.
                            </small>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-search me-2"></i> Lacak Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
    </div>
</div>

<script>
    // Auto focus on input saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const inputKode = document.querySelector('input[name="kode"]');
        if(inputKode) inputKode.focus();
    });
</script>

<style>
    /* Sedikit styling tambahan khusus halaman ini */
    .input-group-text {
        background-color: #f8f9fa;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: none; /* Menghilangkan shadow default bootstrap yg tebal */
    }
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        border-radius: 0.375rem;
    }
</style>
@endsection