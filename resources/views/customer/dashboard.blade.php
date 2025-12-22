@extends('layout.master')

@section('title', 'Dashboard Customer')

@section('content')

<div class="d-flex flex-column mb-4 pt-3">
    <h2 class="fw-bold text-white m-0 text-shadow">
        Hai, {{ Auth::user()->nama ?? Auth::user()->name }}! 👋
    </h2>
    <p class="text-white-50 mb-0 mt-1">
        <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
    </p>
</div>

<div class="row mb-5">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="card h-100 glass-card hover-lift border-0">
            <div class="card-body d-flex flex-row align-items-center p-4">
                <div class="icon-box bg-primary-subtle text-primary rounded-4 me-3">
                    <i class="fas fa-search fa-2x"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-1">Lacak Pesanan</h5>
                    <p class="text-muted small mb-3">Pantau progress pesanan baru Anda.</p>
                    <a href="{{ route('customer.cekKodeForm') }}" class="btn btn-primary rounded-pill btn-sm px-3 stretched-link">
                        Mulai Lacak <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 glass-card hover-lift border-0">
            <div class="card-body d-flex flex-row align-items-center p-4">
                <div class="icon-box bg-info-subtle text-info rounded-4 me-3">
                    <i class="fas fa-book-open fa-2x"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-1">Katalog Jasa</h5>
                    <p class="text-muted small mb-3">Lihat layanan teknik kami.</p>
                    <a href="{{ route('customer.katalog') }}" class="btn btn-info text-white rounded-pill btn-sm px-3 stretched-link">
                        Lihat Katalog <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card glass-card border-0 mb-4 overflow-hidden">
            
            <div class="card-header bg-transparent border-bottom px-4 py-0">
                <ul class="nav nav-tabs card-header-tabs border-0" id="orderTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-3 border-0 bg-transparent fw-bold text-dark" 
                                id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                            <i class="fas fa-list-ul me-2 text-primary"></i> Pesanan Aktif
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-3 border-0 bg-transparent fw-bold text-muted" 
                                id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                            <i class="fas fa-history me-2 text-secondary"></i> Riwayat Pesanan
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-0">
                <div class="tab-content" id="orderTabsContent">
                    
                    <div class="tab-pane fade show active" id="active" role="tabpanel">
                        @if(isset($activeOrders) && count($activeOrders) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 custom-table">
                                    <thead class="bg-light text-uppercase text-muted small">
                                        <tr>
                                            <th class="ps-4 py-3">Kode</th>
                                            <th class="py-3">Proyek</th>
                                            <th class="py-3">Status</th>
                                            <th class="py-3">Update Terakhir</th>
                                            <th class="pe-4 py-3 text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activeOrders as $order)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="fw-bold text-primary">#{{ $order->kode_pesanan }}</div>
                                            </td>
                                            <td>
                                                <span class="fw-semibold text-dark">{{ Str::limit($order->nama_pesanan ?? $order->judul, 30) }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = match($order->status) {
                                                        'Menunggu' => 'bg-warning text-dark',
                                                        'Proses'   => 'bg-primary text-white',
                                                        default    => 'bg-secondary text-white'
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 fw-normal">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $lastProgress = $order->progres->sortByDesc('created_at')->first();
                                                @endphp
                                                @if($lastProgress)
                                                    <div class="d-flex flex-column">
                                                        <small class="text-dark fw-bold">{{ Str::limit($lastProgress->catatan, 25) }}</small>
                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                            <i class="far fa-clock me-1"></i>{{ $lastProgress->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                @else
                                                    <span class="text-muted small fst-italic">- Menunggu update -</span>
                                                @endif
                                            </td>
                                            <td class="pe-4 text-end">
                                                <a href="{{ route('customer.pesanan.show', $order->kode_pesanan) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                    <i class="fas fa-clipboard-list fa-3x text-muted opacity-25"></i>
                                </div>
                                <h5 class="text-muted mb-2">Tidak ada pesanan aktif</h5>
                                <p class="text-muted small mb-0">Pesanan yang sedang dikerjakan akan muncul di sini.</p>
                            </div>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="history" role="tabpanel">
                        @if(isset($historyOrders) && count($historyOrders) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 custom-table">
                                    <thead class="bg-light text-uppercase text-muted small">
                                        <tr>
                                            <th class="ps-4 py-3">Kode</th>
                                            <th class="py-3">Proyek</th>
                                            <th class="py-3">Status</th>
                                            <th class="py-3">Selesai Pada</th>
                                            <th class="pe-4 py-3 text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($historyOrders as $order)
                                        <tr class="opacity-75"> <td class="ps-4">
                                                <div class="fw-bold text-secondary">#{{ $order->kode_pesanan }}</div>
                                            </td>
                                            <td>
                                                <span class="fw-semibold text-secondary">{{ Str::limit($order->nama_pesanan ?? $order->judul, 30) }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-normal">
                                                    <i class="fas fa-check me-1"></i> Selesai
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    // Ambil progress terakhir (biasanya finishing/selesai)
                                                    $lastProgress = $order->progres->sortByDesc('created_at')->first();
                                                @endphp
                                                <small class="text-muted">
                                                    {{ $lastProgress ? $lastProgress->created_at->format('d M Y') : '-' }}
                                                </small>
                                            </td>
                                            <td class="pe-4 text-end">
                                                <a href="{{ route('customer.pesanan.show', $order->kode_pesanan) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                    <i class="fas fa-history fa-3x text-muted opacity-25"></i>
                                </div>
                                <h5 class="text-muted mb-2">Belum ada riwayat pesanan</h5>
                                <p class="text-muted small mb-0">Pesanan yang sudah selesai akan tersimpan di sini.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Tambahan untuk Tabs */
    .nav-tabs .nav-link {
        color: #6c757d;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }
    
    .nav-tabs .nav-link:hover {
        color: #4f46e5;
        border-color: transparent;
    }
    
    .nav-tabs .nav-link.active {
        color: #4f46e5 !important;
        background: transparent;
        border-bottom: 3px solid #4f46e5;
    }
    
    /* ... Style Glass Card dan lainnya biarkan sama seperti sebelumnya ... */
    .glass-card {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        border-radius: 16px;
    }
    /* CSS Variabel */
    :root {
        --glass-bg: rgba(255, 255, 255, 0.92); /* Background putih transparan */
        --glass-border: rgba(255, 255, 255, 0.6);
        --primary-color: #4f46e5;
    }

    /* Text Shadow untuk judul di atas foto */
    .text-shadow {
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    /* Glassmorphism Card Style */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px); /* Efek Blur di belakang kartu */
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1); /* Bayangan lembut */
        border-radius: 16px; /* Sudut lebih bulat */
    }

    /* Hover Animation (Kartu Naik) */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.15);
    }

    /* Icon Box styling */
    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Table Styling */
    .custom-table thead th {
        border-bottom: 2px solid #edf2f7;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .custom-table tbody tr {
        transition: background-color 0.2s;
    }
    .custom-table tbody tr:hover {
        background-color: rgba(79, 70, 229, 0.03); /* Highlight sangat tipis saat hover baris */
    }
    .custom-table td {
        vertical-align: middle;
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .custom-table tr:last-child td {
        border-bottom: none;
    }
</style>
@endsection