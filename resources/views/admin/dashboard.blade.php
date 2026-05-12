@extends('layout.master')

@section('content')
<div class="dashboard-container">
    <div class="statistics-container">
        <div class="stats-header">
            <h2><i class="fas fa-money-bill-wave"></i>Statistik Pendapatan</h2>
            <div class="periode-filter">
                @foreach(['hari' => 'Hari Ini', 'minggu' => 'Minggu Ini', 'bulan' => 'Bulan Ini', 'tahun' => 'Tahun Ini'] as $val => $label)
                    <a href="{{ route('laporan.keuangan', ['periode' => $val]) }}"
                       class="btn-periode {{ $periode === $val ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-waiting">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-count" id="count-menunggu">0</h3>
                    <p class="stat-label">Menunggu</p>
                </div>
                <div class="stat-badge status-menunggu">Pending</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon icon-process">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-count" id="count-proses">0</h3>
                    <p class="stat-label">Dalam Proses</p>
                </div>
                <div class="stat-badge status-proses">Process</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-done">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-count" id="count-selesai">0</h3>
                    <p class="stat-label">Selesai</p>
                </div>
                <div class="stat-badge status-selesai">Done</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon icon-total">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-count" id="count-total">0</h3>
                    <p class="stat-label">Total Pesanan</p>
                </div>
                <div class="stat-badge status-total">All</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-process"><i class="fas fa-hand-holding-usd"></i></div>
                <div class="stat-content">
                    <h3 class="stat-count">Rp {{ number_format($stats['total_dp'], 0, ',', '.') }}</h3>
                    <p class="stat-label">Total DP Masuk</p>
                </div>
                <div class="stat-badge status-proses">DP</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-done"><i class="fas fa-check-circle"></i></div>
                <div class="stat-content">
                    <h3 class="stat-count">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h3>
                    <p class="stat-label">Total Lunas</p>
                </div>
                <div class="stat-badge status-selesai">Lunas</div>
            </div>
        </div>
    </div>

    <div class="statistics-container" style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 20px; color: #1f2937;"><i class="fas fa-chart-bar"></i> Grafik Pendapatan</h3>
        @if(count($grafikData['labels']) > 0)
            <canvas id="grafikPendapatan" height="100"></canvas>
        @else
            <div style="text-align:center; padding: 40px; color: #6b7280;">
                <i class="fas fa-chart-bar" style="font-size: 3rem; margin-bottom: 10px;"></i>
                <p>Tidak ada data untuk periode ini.</p>
            </div>
        @endif
    </div>

    <div class="statistics-container">
        <h3 style="margin-bottom: 20px; color: #1f2937;"><i class="fas fa-list"></i> Riwayat Pembayaran</h3>
        <div style="overflow-x: auto;">
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Nama Pesanan</th>
                        <th>Harga Total</th>
                        <th>Jumlah DP</th>
                        <th>Sisa</th>
                        <th>Status</th>
                        <th>Tanggal Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $p)
                    <tr>
                        <td><code>{{ $p->kode_pesanan }}</code></td>
                        <td>{{ $p->nama_pesanan }}</td>
                        <td>Rp {{ number_format($p->harga_total, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($p->jumlah_dp, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($p->sisa_bayar, 0, ',', '.') }}</td>
                        <td>
                            <span class="stat-badge {{ $p->status_pembayaran === 'lunas' ? 'status-selesai' : ($p->status_pembayaran === 'dp' ? 'status-proses' : 'status-menunggu') }}">
                                {{ strtoupper($p->status_pembayaran) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center; color:#6b7280; padding: 30px;">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">{{ $riwayat->appends(['periode' => $periode])->links() }}</div>
    </div>

    <div class="main-menu">
        <a href="{{ route('pesanan.index') }}" class="menu-item">
            <i class="fas fa-clipboard-list"></i>
            <span>Kelola Pesanan</span>
        </a>
        
        <a href="{{ route('bahan.index') }}" class="menu-item">
            <i class="fas fa-box"></i>
            <span>Kelola Bahan</span>
        </a>
        
        <a href="{{ route('katalog.index') }}" class="menu-item">
            <i class="fas fa-book"></i>
            <span>Kelola Katalog</span>
        </a>
    </div>
</div>

<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    /* Statistics Container */
    .statistics-container {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Bayangan diperhalus */
        border: 1px solid #e9ecef;
    }
    
    .stats-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .stats-header h2 {
        font-size: 1.8rem;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
    }
    
    .stats-header h2 i {
        color: #4f46e5;
        font-size: 1.6rem;
    }
    
    .btn-history {
        background-color: #4f46e5; /* Hapus gradient */
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px; /* Radius dikurangi sedikit */
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background-color 0.2s ease; /* Transisi simpel */
    }
    
    .btn-history:hover {
        background-color: #4338ca; /* Warna solid saat hover */
        /* Hapus transform dan shadow berlebih */
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 20px;
    }
    
    .stat-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        border: 1px solid #e2e8f0;
        position: relative;
        /* Hapus animasi dan efek hover berlebih */
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    /* Ganti Gradient dengan Warna Solid */
    .icon-waiting { background-color: #f59e0b; }
    .icon-process { background-color: #3b82f6; }
    .icon-done { background-color: #10b981; }
    .icon-total { background-color: #8b5cf6; }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-count {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: #1f2937;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .stat-label {
        font-size: 1rem;
        color: #6b7280;
        margin: 0;
        font-weight: 500;
    }
    
    .stat-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .status-menunggu { background-color: #fef3c7; color: #92400e; }
    .status-proses { background-color: #dbeafe; color: #1e40af; }
    .status-selesai { background-color: #d1fae5; color: #065f46; }
    .status-total { background-color: #f3e8ff; color: #5b21b6; }
    
    .stats-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px;
        background: #f0f9ff;
        border-radius: 8px;
        border: 1px solid #e0f2fe;
        color: #0369a1;
        font-size: 0.95rem;
    }
    
    .stats-info i {
        font-size: 1.2rem;
    }
    
    /* Menu Utama */
    .main-menu {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 20px;
    }
    
    .menu-item {
        background: white;
        border-radius: 12px;
        padding: 50px 30px;
        text-align: center;
        text-decoration: none;
        color: #333;
        border: 1px solid #e9ecef;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Shadow tipis */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        transition: border-color 0.2s ease; /* Hanya transisi warna border */
    }
    
    /* Hapus pseudo-element :before (garis animasi) */
    
    .menu-item:hover {
        border-color: #4f46e5;
        /* Hapus transform translateY dan scale */
    }
    
    .menu-item i {
        font-size: 56px;
        margin-bottom: 24px;
        color: #4f46e5;
        /* Hapus transisi scale */
    }
    
    .menu-item span {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    /* Hover color change tetap ada agar user tahu ini tombol, tapi tanpa animasi gerak */
    .menu-item:nth-child(1):hover i { color: #dc2626; }
    .menu-item:nth-child(2):hover i { color: #059669; }
    .menu-item:nth-child(3):hover i { color: #7c3aed; }
    
    /* Responsive Media Queries (Tetap dipertahankan) */
    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 768px) {
        .dashboard-container { margin: 20px auto; padding: 0 15px; }
        .statistics-container { padding: 20px; }
        .stats-header { flex-direction: column; gap: 15px; align-items: flex-start; }
        .btn-history { width: 100%; justify-content: center; }
        .stats-grid { grid-template-columns: 1fr; gap: 15px; }
        .stat-card { padding: 20px; }
        .main-menu { grid-template-columns: 1fr; gap: 20px; }
        .menu-item { padding: 40px 25px; }
        .menu-item i { font-size: 48px; }
        .menu-item span { font-size: 1.3rem; }
    }
    
    @media (max-width: 480px) {
        .menu-item { padding: 35px 20px; }
        .menu-item i { font-size: 42px; }
        .menu-item span { font-size: 1.2rem; }
        .stat-count { font-size: 2rem; }
    }

    periode-filter { display: flex; gap: 8px; flex-wrap: wrap; }
    .btn-periode {
        padding: 8px 18px; border-radius: 8px; border: 1px solid #e2e8f0;
        color: #374151; text-decoration: none; font-size: 0.9rem; font-weight: 500;
        transition: all 0.2s;
    }
    .btn-periode:hover, .btn-periode.active {
        background-color: #4f46e5; color: white; border-color: #4f46e5;
    }
    .table-laporan { width: 100%; border-collapse: collapse; }
    .table-laporan th {
        background: #f8fafc; padding: 12px 16px; text-align: left;
        font-size: 0.9rem; color: #374151; border-bottom: 2px solid #e2e8f0;
    }
    .table-laporan td {
        padding: 12px 16px; border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem; color: #1f2937;
    }
    .table-laporan tr:hover td { background: #f8fafc; }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@if(count($grafikData['labels']) > 0)
const ctx = document.getElementById('grafikPendapatan').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($grafikData['labels']),
        datasets: [
            {
                label: 'Lunas',
                data: @json($grafikData['lunas']),
                backgroundColor: '#10b981',
                borderRadius: 6,
            },
            {
                label: 'DP',
                data: @json($grafikData['dp']),
                backgroundColor: '#3b82f6',
                borderRadius: 6,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: val => 'Rp ' + val.toLocaleString('id-ID')
                }
            }
        }
    }
});
@endif

document.addEventListener('DOMContentLoaded', function() {
    // Menghapus event listener hover manual (JS) karena tidak diperlukan lagi
    
    // Fungsi untuk mengambil data statistik dari API
    async function fetchOrderStats() {
        try {
            const response = await fetch('/api/dashboard/stats');
            if (!response.ok) throw new Error('Network response was not ok');
            
            const data = await response.json();
            
            // Update counter langsung tanpa animasi scale
            updateCounter('count-menunggu', data.menunggu || 0);
            updateCounter('count-proses', data.proses || 0);
            updateCounter('count-selesai', data.selesai || 0);
            updateCounter('count-total', data.total || 0);
            
        } catch (error) {
            console.error('Error fetching stats:', error);
            // Fallback data jika API gagal
            updateCounter('count-menunggu', {{ \App\Models\Pesanan::where('status', 'menunggu')->count() }});
            updateCounter('count-proses', {{ \App\Models\Pesanan::where('status', 'proses')->count() }});
            updateCounter('count-selesai', {{ \App\Models\Pesanan::where('status', 'selesai')->count() }});
            updateCounter('count-total', {{ \App\Models\Pesanan::count() }});
        }
    }
    
    // Fungsi update counter sederhana
    function updateCounter(elementId, newValue) {
        const element = document.getElementById(elementId);
        element.textContent = newValue;
    }
    
    // Load data pertama kali
    fetchOrderStats();
    
    // Update data setiap 30 detik
    setInterval(fetchOrderStats, 30000);
});
</script>

<noscript>
    <style>
        .stats-info {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }
        .stats-info i {
            color: #dc2626;
        }
    </style>
    <div style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-top: 20px; border: 1px solid #fecaca;">
        <strong><i class="fas fa-exclamation-triangle"></i> Catatan:</strong> 
        JavaScript diperlukan untuk fitur realtime. Statistik saat ini:
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 10px;">
            <div>Menunggu: {{ \App\Models\Pesanan::where('status', 'menunggu')->count() }}</div>
            <div>Proses: {{ \App\Models\Pesanan::where('status', 'proses')->count() }}</div>
            <div>Selesai: {{ \App\Models\Pesanan::where('status', 'selesai')->count() }}</div>
            <div>Total: {{ \App\Models\Pesanan::count() }}</div>
        </div>
    </div>
</noscript>

@endsection