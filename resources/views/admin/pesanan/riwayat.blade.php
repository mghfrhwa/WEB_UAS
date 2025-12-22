@extends('layout.master')

@section('title', 'Riwayat Pesanan')

@section('content')

<div class="riwayat-container">
    <div class="riwayat-header">
        <h2><i class="fas fa-history"></i> Riwayat Pesanan</h2>
        <div class="total-info">
            <span class="total-label">Total Pesanan:</span>
            <span class="total-value">{{ $pesanan->count() }}</span>
        </div>
    </div>

    <div class="riwayat-table-container">
        <table class="riwayat-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pesanan</th>
                    <th>Nama Pesanan</th>
                    <th>Status</th>
                    <th>Total Biaya</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanan as $i => $p)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>
                        <span class="kode-badge">
                            <i class="fas fa-barcode"></i> {{ $p->kode_pesanan }}
                        </span>
                    </td>
                    <td class="nama-pesanan">{{ $p->nama_pesanan }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($p->status) }}">
                            @if($p->status == 'menunggu')
                                <i class="fas fa-clock"></i> {{ ucfirst($p->status) }}
                            @elseif($p->status == 'proses')
                                <i class="fas fa-cogs"></i> {{ ucfirst($p->status) }}
                            @else
                                <i class="fas fa-check-circle"></i> {{ ucfirst($p->status) }}
                            @endif
                        </span>
                    </td>
                    <td class="total-biaya">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                    <td class="tanggal">
                        <div class="tanggal-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $p->created_at->format('d-m-Y') }}
                        </div>
                        <div class="waktu-item">
                            <i class="fas fa-clock"></i>
                            {{ $p->created_at->format('H:i') }}
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('pesanan.show', $p->id) }}" class="btn-detail" title="Lihat Detail">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <div class="empty-content">
                            <i class="fas fa-clipboard-list"></i>
                            <h3>Belum Ada Riwayat Pesanan</h3>
                            <p>Tidak ada pesanan yang tercatat dalam riwayat</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .riwayat-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        animation: fadeIn 0.5s ease;
    }
    
    .riwayat-header {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(79, 70, 229, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .riwayat-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .riwayat-header h2 i {
        font-size: 1.6rem;
    }
    
    .total-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 5px;
    }
    
    .total-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .total-value {
        font-size: 2rem;
        font-weight: 700;
    }
    
    .riwayat-table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }
    
    .riwayat-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    
    .riwayat-table thead {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }
    
    .riwayat-table th {
        padding: 20px 15px;
        text-align: left;
        font-weight: 600;
        color: #2d3748;
        font-size: 0.95rem;
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .riwayat-table td {
        padding: 20px 15px;
        border-bottom: 1px solid #f1f5f9;
        color: #4a5568;
        vertical-align: middle;
    }
    
    .riwayat-table tbody tr {
        transition: all 0.3s ease;
    }
    
    .riwayat-table tbody tr:hover {
        background-color: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .text-center {
        text-align: center;
    }
    
    .kode-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 8px 12px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        font-size: 0.9rem;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .kode-badge i {
        color: #4f46e5;
        font-size: 0.9rem;
    }
    
    .nama-pesanan {
        font-weight: 500;
        color: #2d3748;
        font-size: 1rem;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
    }
    
    .status-badge i {
        font-size: 0.9rem;
    }
    
    .status-menunggu {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    
    .status-proses {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }
    
    .status-selesai {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .total-biaya {
        font-weight: 600;
        color: #059669;
        font-size: 1.1rem;
        font-family: 'Courier New', monospace;
    }
    
    .tanggal {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .tanggal-item, .waktu-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #6b7280;
    }
    
    .tanggal-item i, .waktu-item i {
        color: #9ca3af;
        font-size: 0.8rem;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-detail:hover {
        background: linear-gradient(135deg, #0284c7, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        text-decoration: none;
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #f8fafc;
    }
    
    .empty-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    
    .empty-content i {
        font-size: 64px;
        color: #cbd5e1;
    }
    
    .empty-content h3 {
        color: #64748b;
        font-size: 1.5rem;
        margin: 0;
    }
    
    .empty-content p {
        color: #94a3b8;
        font-size: 1rem;
        margin: 0;
    }
    
    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInRow {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .riwayat-container {
            padding: 0 15px;
            margin: 30px auto;
        }
        
        .riwayat-header {
            padding: 25px;
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }
        
        .total-info {
            align-items: flex-start;
        }
    }
    
    @media (max-width: 768px) {
        .riwayat-header h2 {
            font-size: 1.5rem;
        }
        
        .total-value {
            font-size: 1.8rem;
        }
        
        .riwayat-table-container {
            overflow-x: auto;
            border-radius: 15px;
        }
        
        .riwayat-table th,
        .riwayat-table td {
            padding: 15px 12px;
            font-size: 0.9rem;
        }
        
        .status-badge {
            min-width: 100px;
            padding: 6px 12px;
        }
        
        .btn-detail {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 480px) {
        .riwayat-header {
            padding: 20px;
            border-radius: 15px;
        }
        
        .riwayat-header h2 {
            font-size: 1.3rem;
            gap: 10px;
        }
        
        .total-value {
            font-size: 1.5rem;
        }
        
        .empty-content i {
            font-size: 48px;
        }
        
        .empty-content h3 {
            font-size: 1.2rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to table rows
    const rows = document.querySelectorAll('.riwayat-table tbody tr');
    
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(10px)';
        row.style.animation = `fadeInRow 0.3s ease ${index * 0.1}s forwards`;
    });
    
    // Add CSS for row animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
});
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection