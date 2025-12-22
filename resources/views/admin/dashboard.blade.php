@extends('layout.master')

@section('content')
<div class="dashboard-container">
    <div class="statistics-container">
        <div class="stats-header">
            <h2><i class="fas fa-chart-line"></i> Statistik Pesanan</h2>
            <button class="btn-history" onclick="window.location.href='{{ route('pesanan.riwayat') }}'">
                <i class="fas fa-history"></i> Riwayat Pesanan
            </button>
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
        </div>
        
        <div class="stats-info">
            <i class="fas fa-info-circle"></i>
            <span>Data diperbarui secara realtime setiap 30 detik</span>
        </div>
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
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
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