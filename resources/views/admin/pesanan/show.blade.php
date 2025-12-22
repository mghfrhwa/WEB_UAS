@extends('layout.master')

@section('title', 'Detail Pesanan')

@section('content')

<div class="detail-container">
    <div class="detail-header">
        <h2><i class="fas fa-file-alt"></i> Detail Pesanan</h2>
        
        {{-- Button Kembali (Warna Abu-abu Asli) --}}
        <a href="{{ route('pesanan.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="main-container">
        <div class="info-container">
            <div class="info-header">
                <i class="fas fa-info-circle"></i>
                <h3>Informasi Pesanan</h3>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-clipboard-list"></i> Nama Pesanan
                    </div>
                    <div class="info-value">{{ $pesanan->nama_pesanan }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-flag"></i> Status
                    </div>
                    <div class="info-value">
                        <span class="status-badge status-{{ strtolower($pesanan->status) }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-money-bill-wave"></i> Total Biaya
                    </div>
                    <div class="info-value total-biaya">Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-calendar-alt"></i> Tanggal Mulai
                    </div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d F Y') }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-calendar-check"></i> Tanggal Selesai
                    </div>
                    <div class="info-value">
                        @if(strtolower($pesanan->status) == 'selesai' && $pesanan->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d F Y') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-align-left"></i>
                <h3>Deskripsi Pesanan</h3>
            </div>
            <div class="section-content">
                <p>{{ $pesanan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>

        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-calculator"></i>
                <h3>Rincian Biaya</h3>
            </div>
            <div class="biaya-grid">
                <div class="biaya-item">
                    <span class="biaya-label">Biaya Jasa</span>
                    <span class="biaya-value">Rp {{ number_format($pesanan->biaya_jasa, 0, ',', '.') }}</span>
                </div>
                <div class="biaya-item">
                    <span class="biaya-label">Biaya Bahan</span>
                    <span class="biaya-value">Rp {{ number_format($pesanan->total_biaya - $pesanan->biaya_jasa, 0, ',', '.') }}</span>
                </div>
                <div class="biaya-item total">
                    <span class="biaya-label">Total Keseluruhan</span>
                    <span class="biaya-value">Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-box"></i>
                <h3>Bahan yang Digunakan</h3>
            </div>
            
            @if($pesanan->bahanDipakai->count() > 0)
            <div class="table-container">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->bahanDipakai as $i => $pb)
                        <tr>
                            <td class="text-center">{{ $i+1 }}</td>
                            <td>{{ $pb->bahan->nama }}</td>
                            <td>{{ $pb->jumlah }} {{ $pb->bahan->satuan }}</td>
                            <td>Rp {{ number_format($pb->bahan->harga, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($pb->jumlah * $pb->bahan->harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>Tidak ada data bahan yang digunakan</p>
            </div>
            @endif
        </div>

        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-chart-line"></i>
                <h3>Progress Pesanan</h3>
            </div>
            
            @if($pesanan->progres->count() > 0)
            <div class="progress-timeline">
                @foreach($pesanan->progres->sortByDesc('tanggal_progres') as $prog)
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <span class="tahap-badge">{{ $prog->tahap_status }}</span>
                            <span class="timeline-date">
                                <i class="far fa-clock"></i>
                                {{ \Carbon\Carbon::parse($prog->tanggal_progres)->format('d F Y - H:i') }}
                            </span>
                        </div>
                        <div class="timeline-body">
                            <p>{{ $prog->catatan }}</p>
                            @if($prog->foto)
                            <div class="timeline-photo">
                                <img src="{{ asset('storage/progres/'.$prog->foto) }}" 
                                     alt="Foto Progres" 
                                     onclick="openImageModal(this.src)">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-tasks"></i>
                <p>Belum ada progress yang dicatat</p>
            </div>
            @endif
        </div>
    </div>
</div>

<div id="imageModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <img id="modalImage" alt="Preview Foto">
    </div>
</div>

<style>
    .detail-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    /* Header */
    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e7eb;
    }
    
    /* Hapus header-main wrapper karena kita pakai direct flex space-between */
    
    .detail-header h2 {
        font-size: 1.8rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    
    .detail-header h2 i {
        color: #4f46e5;
    }
    
    /* Tombol Kembali dengan Warna Abu-abu Asli */
    .btn-back {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: linear-gradient(135deg, #4b5563, #374151);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    }
    
    /* Kontainer Utama */
    .main-container {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    /* Kontainer Informasi */
    .info-container {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }
    
    .info-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .info-header i {
        color: #4f46e5;
        font-size: 1.5rem;
    }
    
    .info-header h3 {
        font-size: 1.3rem;
        color: #374151;
        margin: 0;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .info-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    .info-label i {
        color: #4f46e5;
        font-size: 0.9rem;
    }
    
    .info-value {
        font-size: 1.1rem;
        color: #1f2937;
        font-weight: 600;
    }
    
    .total-biaya {
        color: #059669;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
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
    
    /* Detail Sections */
    .detail-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .section-header i {
        color: #4f46e5;
        font-size: 1.5rem;
    }
    
    .section-header h3 {
        font-size: 1.3rem;
        color: #374151;
        margin: 0;
    }
    
    .section-content p {
        color: #4b5563;
        line-height: 1.6;
        font-size: 1rem;
    }
    
    /* Biaya Grid */
    .biaya-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .biaya-item {
        background: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }
    
    .biaya-item.total {
        background: #f0fdf4;
        border-color: #bbf7d0;
    }
    
    .biaya-label {
        display: block;
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 5px;
    }
    
    .biaya-value {
        display: block;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .biaya-item.total .biaya-value {
        color: #059669;
    }
    
    /* Table */
    .table-container {
        overflow-x: auto;
    }
    
    .detail-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }
    
    .detail-table thead {
        background: #f8fafc;
    }
    
    .detail-table th {
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.9rem;
    }
    
    .detail-table td {
        padding: 15px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #4b5563;
    }
    
    .detail-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .text-center {
        text-align: center;
    }
    
    .text-right {
        text-align: right;
    }
    
    /* Progress Timeline */
    .progress-timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .progress-timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }
    
    .timeline-item {
        display: flex;
        margin-bottom: 25px;
        position: relative;
    }
    
    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 30px;
        display: flex;
        justify-content: center;
    }
    
    .timeline-marker i {
        color: #4f46e5;
        font-size: 14px;
        background: white;
        padding: 2px;
        border-radius: 50%;
    }
    
    .timeline-content {
        flex: 1;
        background: #f8fafc;
        border-radius: 8px;
        padding: 20px;
        border: 1px solid #e5e7eb;
    }
    
    .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .tahap-badge {
        background: #4f46e5;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .timeline-date {
        font-size: 0.85rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .timeline-body p {
        color: #4b5563;
        line-height: 1.6;
        margin: 0 0 15px 0;
    }
    
    .timeline-photo img {
        max-width: 200px;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s ease;
        border: 2px solid #e5e7eb;
    }
    
    .timeline-photo img:hover {
        transform: scale(1.05);
        border-color: #4f46e5;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #d1d5db;
    }
    
    .empty-state p {
        font-size: 1rem;
        margin-bottom: 20px;
    }
    
    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    
    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
    }
    
    .modal-content img {
        max-width: 100%;
        max-height: 90vh;
        border-radius: 8px;
    }
    
    .modal-close {
        position: absolute;
        top: -40px;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 32px;
        cursor: pointer;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .detail-container {
            margin: 20px auto;
            padding: 0 15px;
        }
        
        .detail-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .biaya-grid {
            grid-template-columns: 1fr;
        }
        
        .detail-section {
            padding: 20px;
        }
        
        .timeline-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('imageModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('imageModal').style.display === 'flex') {
        closeModal();
    }
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection