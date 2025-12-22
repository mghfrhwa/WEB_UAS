@extends('layout.master')

@section('title', 'Dashboard Customer')

@section('content')
<div class="container-fluid pt-5" style="margin-top: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark m-0">Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->name }}!</h2>
        <div class="date-pill">
            <i class="far fa-calendar-alt me-2"></i> {{ date('d M Y') }}
        </div>
    </div>
    
    <!-- Statistik Ringkasan -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card text-center h-100 shadow-sm border-0 rounded-3">
                <div class="card-body d-flex flex-column justify-content-center p-4">
                    <div class="bg-primary-subtle rounded-circle d-inline-flex p-3 mb-3 mx-auto">
                        <i class="fas fa-search fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Lacak Pesanan Baru</h5>
                    <p class="text-muted mb-3">Punya kode pesanan baru? Masukkan di sini untuk mulai memantau.</p>
                    <a href="{{ route('customer.cekKodeForm') }}" class="btn btn-primary px-4 rounded-pill mt-auto">
                        <i class="fas fa-plus me-2"></i> Lacak Pesanan
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card text-center h-100 shadow-sm border-0 rounded-3">
                <div class="card-body d-flex flex-column justify-content-center p-4">
                    <div class="bg-info-subtle rounded-circle d-inline-flex p-3 mb-3 mx-auto">
                        <i class="fas fa-images fa-2x text-info"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Lihat Katalog</h5>
                    <p class="text-muted mb-3">Lihat portfolio dan pilihan jasa yang kami tawarkan</p>
                    <a href="{{ route('customer.katalog') }}" class="btn btn-info text-white px-4 rounded-pill mt-auto">
                        <i class="fas fa-eye me-2"></i> Jelajahi Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Pesanan -->
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card border rounded-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Proyek Saya</p>
                            <h3 class="fw-bold mb-0">{{ $totalOrders ?? 0 }}</h3>
                        </div>
                        <div class="stat-icon icon-total">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card border rounded-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Dalam Proses</p>
                            <h3 class="fw-bold mb-0">{{ $inProgressOrders ?? 0 }}</h3>
                        </div>
                        <div class="stat-icon icon-process">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card border rounded-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Menunggu</p>
                            <h3 class="fw-bold mb-0">{{ $pendingOrders ?? 0 }}</h3>
                        </div>
                        <div class="stat-icon icon-waiting">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card border rounded-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Selesai</p>
                            <h3 class="fw-bold mb-0">{{ $completedOrders ?? 0 }}</h3>
                        </div>
                        <div class="stat-icon icon-done">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigasi untuk Daftar Pesanan -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border rounded-3 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <ul class="nav nav-tabs card-header-tabs" id="pesananTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="aktif-tab" data-bs-toggle="tab" data-bs-target="#aktif" type="button" role="tab">
                                <i class="fas fa-list-ul me-2"></i>Pesanan Aktif
                                @if(isset($activeOrdersCount) && $activeOrdersCount > 0)
                                <span class="badge bg-primary ms-2">{{ $activeOrdersCount }}</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="riwayat-tab" data-bs-toggle="tab" data-bs-target="#riwayat" type="button" role="tab">
                                <i class="fas fa-history me-2"></i>Riwayat Pesanan
                                @if(isset($historyOrdersCount) && $historyOrdersCount > 0)
                                <span class="badge bg-secondary ms-2">{{ $historyOrdersCount }}</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item ms-auto">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari pesanan..." id="searchPesanan">
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body p-0">
                    <div class="tab-content" id="pesananTabContent">
                        <!-- Tab Pesanan Aktif -->
                        <div class="tab-pane fade show active" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">
                            @if(isset($activeOrders) && $activeOrders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4 py-3">Kode</th>
                                                <th class="py-3">Judul Proyek</th>
                                                <th class="py-3">Status</th>
                                                <th class="py-3">Progress Terakhir</th>
                                                <th class="pe-4 py-3 text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activeOrders as $order)
                                            <tr class="pesanan-row">
                                                <td class="ps-4">
                                                    <span class="badge bg-light text-primary border border-primary font-monospace">
                                                        {{ $order->kode_pesanan }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold text-dark">{{ Str::limit($order->nama_pesanan ?? $order->judul, 40) }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = match($order->status) {
                                                            'Menunggu' => 'bg-warning text-dark',
                                                            'Proses' => 'bg-primary',
                                                            'Selesai' => 'bg-success',
                                                            default => 'bg-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $statusClass }} rounded-pill bg-opacity-75">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $lastProgress = $order->progres->sortByDesc('created_at')->first();
                                                    @endphp
                                                    @if($lastProgress)
                                                        <small class="text-muted d-block">{{ Str::limit($lastProgress->catatan, 30) }}</small>
                                                        <small class="text-xs text-muted">{{ $lastProgress->created_at->diffForHumans() }}</small>
                                                    @else
                                                        <span class="text-muted small">- Belum ada update -</span>
                                                    @endif
                                                </td>
                                                <td class="pe-4 text-end">
                                                    <a href="{{ route('customer.pesanan.show', $order->kode_pesanan) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
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
                                        <i class="fas fa-check-circle fa-3x text-success opacity-50"></i>
                                    </div>
                                    <h5 class="text-muted mb-2">Tidak ada pesanan aktif</h5>
                                    <p class="text-muted small mb-3">Semua pesanan Anda sudah selesai atau belum ada pesanan.</p>
                                    <a href="{{ route('customer.cekKodeForm') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus me-2"></i> Lacak Pesanan Baru
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Tab Riwayat Pesanan -->
                        <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                            @if(isset($historyOrders) && $historyOrders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4 py-3">Kode</th>
                                                <th class="py-3">Judul Proyek</th>
                                                <th class="py-3">Tanggal Selesai</th>
                                                <th class="py-3">Total Biaya</th>
                                                <th class="pe-4 py-3 text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($historyOrders as $order)
                                            <tr class="pesanan-row">
                                                <td class="ps-4">
                                                    <span class="badge bg-light text-secondary border font-monospace">
                                                        {{ $order->kode_pesanan }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold text-dark">{{ Str::limit($order->nama_pesanan ?? $order->judul, 40) }}</td>
                                                <td>
                                                    @if($order->tanggal_selesai)
                                                        {{ \Carbon\Carbon::parse($order->tanggal_selesai)->format('d M Y') }}
                                                    @else
                                                        <span class="text-muted small">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-success fw-bold">
                                                    Rp {{ number_format($order->total_biaya ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td class="pe-4 text-end">
                                                    <a href="{{ route('customer.pesanan.show', $order->kode_pesanan) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                        <i class="fas fa-eye me-1"></i> Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($historyOrders->count() >= 15)
                                    <div class="text-center py-3 border-top">
                                        <small class="text-muted">Menampilkan 15 pesanan terakhir yang selesai</small>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                        <i class="fas fa-history fa-3x text-muted opacity-50"></i>
                                    </div>
                                    <h5 class="text-muted mb-2">Belum ada riwayat pesanan</h5>
                                    <p class="text-muted small mb-3">Pesanan yang sudah selesai akan muncul di sini.</p>
                                    <a href="{{ route('customer.cekKodeForm') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-search me-2"></i> Lacak Pesanan
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Pencarian pesanan
    document.getElementById('searchPesanan')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const activeTab = document.querySelector('#pesananTab .nav-link.active').getAttribute('data-bs-target');
        const rows = document.querySelectorAll(`${activeTab} .pesanan-row`);
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Reset pencarian saat ganti tab
    document.querySelectorAll('#pesananTab button[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function() {
            document.getElementById('searchPesanan').value = '';
            const activeTab = this.getAttribute('data-bs-target');
            const rows = document.querySelectorAll(`${activeTab} .pesanan-row`);
            rows.forEach(row => row.style.display = '');
        });
    });
    
    // Animasi untuk tabel row
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.pesanan-row');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
</script>
@endpush

<style>
    /* Styling tambahan */
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --warning-color: #f59e0b;
        --success-color: #10b981;
        --info-color: #3b82f6;
        --purple-color: #8b5cf6;
        --card-bg: #f8fafc;
        --border-color: #e2e8f0;
    }
    
    .stat-card {
        background: var(--card-bg);
        border-color: var(--border-color) !important;
        transition: all 0.2s ease;
    }
    
    .stat-card:hover {
        border-color: var(--primary-color) !important;
        transform: translateY(-3px);
    }
    
    .stat-icon {
        width: 50px; height: 50px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: white;
    }
    
    .icon-total { background-color: var(--purple-color); }
    .icon-process { background-color: var(--info-color); }
    .icon-waiting { background-color: var(--warning-color); }
    .icon-done { background-color: var(--success-color); }
    
    .bg-primary-subtle { background-color: rgba(79, 70, 229, 0.1) !important; }
    .bg-info-subtle { background-color: rgba(59, 130, 246, 0.1) !important; }
    .text-primary { color: var(--primary-color) !important; }
    .text-info { color: var(--info-color) !important; }
    
    .date-pill {
        background: linear-gradient(135deg, #e0e7ff, #f3e8ff);
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        color: #4f46e5;
        display: inline-flex;
        align-items: center;
    }
    
    /* Tab Styling */
    .nav-tabs .nav-link {
        color: #6b7280;
        font-weight: 500;
        padding: 10px 20px;
        border: none;
        background: none;
        position: relative;
    }
    
    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        font-weight: 600;
    }
    
    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--purple-color));
        border-radius: 3px 3px 0 0;
    }
    
    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 8px 12px;
            font-size: 0.9rem;
        }
        
        .date-pill {
            margin-top: 10px;
            padding: 6px 12px;
            font-size: 0.9rem;
        }
        
        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .input-group.input-group-sm {
            width: 100% !important;
            margin-top: 10px;
        }
    }
</style>
@endsection