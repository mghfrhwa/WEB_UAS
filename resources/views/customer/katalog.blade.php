@extends('layout.master')

@section('title', 'Katalog Jasa & Produk')

@section('content')

<div class="header-banner mb-5 pt-4 pb-3 rounded-bottom-4 position-relative overflow-hidden">
    <div class="container position-relative z-2">
        <div class="d-flex flex-column align-items-center text-center">
            <div class="badge-pill-glow mb-3 animate-fade-down">
                <i class="fas fa-certificate me-2"></i>Official Catalogue
            </div>
            <h2 class="fw-bold text-white m-0 display-5 text-shadow-sm animate-fade-up">
                Solusi Teknik & Produk
            </h2>
            <p class="text-white-50 mt-3 fs-5 mw-600 animate-fade-up delay-100">
                Temukan berbagai mesin dan jasa teknik berkualitas tinggi yang dirancang untuk kebutuhan bisnis Anda.
            </p>
        </div>
    </div>
    <div class="bg-decoration-circle-1"></div>
    <div class="bg-decoration-circle-2"></div>
</div>

<div class="container mb-5 animate-fade-in delay-200">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-3 glass-panel rounded-4">
        <div class="d-flex align-items-center">
            <div class="icon-box bg-primary-soft text-primary rounded-circle me-3">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <h6 class="mb-0 fw-bold text-dark">Total Item</h6>
                <small class="text-muted">{{ $katalog->count() }} Produk Tersedia</small>
            </div>
        </div>
        </div>
</div>

@if($katalog->count() > 0)
<div class="container pb-5">
    <div class="row g-4">
        @foreach($katalog as $item)
        <div class="col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch animate-fade-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="card product-card h-100 border-0 shadow-sm w-100">
                
                <div class="card-img-wrapper position-relative overflow-hidden">
                    <div class="price-tag position-absolute top-0 end-0 m-3 z-3">
                        @if($item->harga)
                            <span class="badge bg-white text-primary shadow-sm px-3 py-2 rounded-pill fw-bold border border-light">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="badge bg-success text-white shadow-sm px-3 py-2 rounded-pill fw-bold">
                                <i class="fab fa-whatsapp me-1"></i> Hubungi Kami
                            </span>
                        @endif
                    </div>

                    @if(!empty($item->foto))
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             class="card-img-top object-fit-cover w-100 h-100 transition-zoom" 
                             alt="{{ $item->judul }}"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        
                        <div class="fallback-img w-100 h-100 bg-light d-none align-items-center justify-content-center flex-column">
                            <i class="fas fa-image fa-3x text-secondary opacity-25 mb-2"></i>
                            <span class="small text-muted">Gambar tidak tersedia</span>
                        </div>
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light-gradient">
                            <i class="fas fa-cube fa-4x text-primary opacity-25"></i>
                        </div>
                    @endif
                    
                    <!-- <div class="hover-overlay d-flex align-items-center justify-content-center">
                        <span class="btn btn-light btn-sm rounded-pill px-4 fw-bold shadow-sm transform-up">Lihat Detail</span>
                    </div> -->
                </div>

                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold text-dark mb-2 text-truncate-2" title="{{ $item->judul }}">
                        {{ $item->judul }}
                    </h5>
                    
                    <div class="separator-dash my-3"></div>

                    <p class="card-text text-muted small flex-grow-1 mb-4 lh-base">
                        {{ Str::limit($item->deskripsi ?? 'Deskripsi detail untuk produk ini belum tersedia.', 80) }}
                    </p>
                    
                    <div class="mt-auto">
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tertarik%20dengan%20produk:%20{{ urlencode($item->judul) }}" 
                           target="_blank" 
                           class="btn btn-whatsapp w-100 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="fab fa-whatsapp fs-5"></i>
                            <span>Pesan Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="container py-5">
    <div class="row justify-content-center animate-fade-in">
        <div class="col-md-6 col-lg-5">
            <div class="text-center p-5 glass-panel rounded-4">
                <div class="mb-4">
                    <div class="bg-light d-inline-block rounded-circle p-4 shadow-inner">
                        <i class="fas fa-search fa-3x text-muted opacity-50"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-3">Katalog Belum Tersedia</h4>
                <p class="text-muted mb-4">Kami sedang menyiapkan produk dan layanan terbaik untuk Anda. Silakan kembali lagi nanti.</p>
                <a href="https://wa.me/6281234567890" class="btn btn-outline-primary rounded-pill px-4">
                    Hubungi Admin
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    /* === VARIABLES === */
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #64748b;
        --whatsapp-color: #25D366;
        --card-bg: rgba(255, 255, 255, 0.9);
        --glass-border: 1px solid rgba(255, 255, 255, 0.5);
    }

    /* === UTILS === */
    .mw-600 { max-width: 600px; }
    .text-shadow-sm { text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .object-fit-cover { object-fit: cover; }
    .z-2 { z-index: 2; }
    .z-3 { z-index: 3; }
    
    /* === HEADER & DECORATION === */
    .header-banner {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }

    .bg-decoration-circle-1 {
        position: absolute;
        top: -50%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        z-index: 1;
    }

    .bg-decoration-circle-2 {
        position: absolute;
        bottom: -30%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        z-index: 1;
    }

    .badge-pill-glow {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(4px);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* === GLASS PANELS === */
    .glass-panel {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: var(--glass-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* === PRODUCT CARD === */
    .product-card {
        background: #fff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        border-radius: 16px;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    }

    .card-img-wrapper {
        height: 240px;
        background: #f1f5f9;
    }

    .bg-light-gradient {
        background: linear-gradient(to top right, #f1f5f9, #e2e8f0);
    }

    .transition-zoom {
        transition: transform 0.5s ease;
    }

    .product-card:hover .transition-zoom {
        transform: scale(1.08);
    }

    /* Hover Overlay pada Gambar */
    .hover-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .hover-overlay {
        opacity: 1;
    }

    .transform-up {
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .product-card:hover .transform-up {
        transform: translateY(0);
    }

    /* === TYPOGRAPHY & ELEMENTS === */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 3rem; /* Menjaga tinggi judul tetap konsisten */
    }

    .separator-dash {
        width: 40px;
        height: 3px;
        background-color: #e2e8f0;
        border-radius: 2px;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .bg-primary-soft { background-color: #e0e7ff; }

    /* === BUTTONS === */
    .btn-whatsapp {
        background-color: var(--whatsapp-color);
        color: white;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-whatsapp:hover {
        background-color: #1ebc57;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
    }

    /* === ANIMATIONS === */
    .animate-fade-in { animation: fadeIn 0.8s ease forwards; opacity: 0; }
    .animate-fade-up { animation: fadeUp 0.8s ease forwards; opacity: 0; }
    .animate-fade-down { animation: fadeDown 0.8s ease forwards; opacity: 0; }
    
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }

    @keyframes fadeIn {
        from { opacity: 0; } to { opacity: 1; }
    }
    
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
        .card-img-wrapper { height: 200px; }
        .header-banner { border-radius: 0 0 20px 20px; }
    }
</style>
@endsection