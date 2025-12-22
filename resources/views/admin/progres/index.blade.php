@extends('layout.master')

@section('title', 'Progres Pesanan')

@section('content')

<div class="progres-container">
    <div class="progres-header">
        <div class="header-top">
            <h2><i class="fas fa-tasks"></i> Progres Pesanan</h2>
            
            <a href="{{ route('progres.create', ['pesanan_id' => $pesanan->id]) }}" class="btn-tambah">
                <i class="fas fa-plus"></i> Tambah Progres
            </a>
        </div>
        
        <div class="header-info">
            <div class="info-card">
                <div class="info-item">
                    <span class="label">Nama Pesanan</span>
                    <span class="value">{{ $pesanan->nama_pesanan }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Kode</span>
                    <span class="value font-mono">{{ $pesanan->kode_pesanan }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="progres-timeline">
        @if($progres->isEmpty())
        <div class="empty-state">
            <i class="fas fa-clipboard-list"></i>
            <h3>Belum Ada Progres</h3>
            <p>Tambahkan progres pertama untuk pesanan ini</p>
            <br>
            <a href="{{ route('progres.create', ['pesanan_id' => $pesanan->id]) }}" class="btn-tambah-kosong">
                <i class="fas fa-plus"></i> Tambah Sekarang
            </a>
        </div>
        @else
            @foreach($progres as $pr)
            <div class="timeline-item">
                <div class="timeline-marker">
                    <div class="marker-dot"></div>
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="tahap-badge">{{ $pr->tahap_status }}</span>
                        <span class="tanggal">{{ $pr->tanggal_progres }}</span>
                    </div>
                    
                    <div class="timeline-body">
                        <p class="catatan">{{ $pr->catatan }}</p>
                        
                        @if($pr->foto)
                        <div class="foto-preview">
                            <img src="{{ asset('storage/progres/'.$pr->foto) }}" 
                                 alt="Foto Progres"
                                 onclick="openImageModal('{{ asset('storage/progres/'.$pr->foto) }}')">
                        </div>
                        @endif
                    </div>
                    
                    <div class="timeline-footer">
                        <a href="{{ route('progres.edit', $pr->id) }}" class="btn-aksi btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <form action="{{ route('progres.destroy', $pr->id) }}" method="POST" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-aksi btn-hapus" onclick="konfirmasiHapusProgres(this)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>

<div class="modal" id="imageModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeImageModal()">&times;</button>
        <img id="modalImage" src="" alt="Preview Foto">
    </div>
</div>

<style>
    .progres-container { max-width: 900px; margin: 40px auto; padding: 0 20px; }
    
    /* Header Cleaner */
    .progres-header { margin-bottom: 30px; }
    .header-top {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 20px;
    }
    .header-top h2 { font-size: 1.8rem; color: #2d3748; margin: 0; display: flex; align-items: center; gap: 10px; }
    .header-top h2 i { color: #4f46e5; }

    .info-card {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 8px;
        padding: 15px 20px; display: flex; gap: 40px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .info-item { display: flex; flex-direction: column; }
    .info-item .label { font-size: 0.8rem; color: #64748b; text-transform: uppercase; margin-bottom: 2px; }
    .info-item .value { font-weight: 600; color: #1e293b; font-size: 1rem; }
    .font-mono { font-family: 'Consolas', monospace; }

    /* Buttons */
    .btn-tambah {
        background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white;
        padding: 10px 20px; border-radius: 6px; text-decoration: none;
        font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 8px;
        transition: opacity 0.2s;
    }
    .btn-tambah:hover { opacity: 0.9; color: white; }

    /* Timeline Cleaner */
    .progres-timeline { position: relative; padding: 10px 0; }
    .progres-timeline:before {
        content: ''; position: absolute; left: 20px; top: 0; bottom: 0;
        width: 2px; background: #e2e8f0;
    }

    .timeline-item { display: flex; margin-bottom: 30px; position: relative; }
    .timeline-marker { width: 40px; display: flex; justify-content: center; z-index: 1; margin-right: 20px; }
    .marker-dot {
        width: 14px; height: 14px; background: #fff; border: 3px solid #4f46e5;
        border-radius: 50%; margin-top: 5px;
    }

    .timeline-content {
        flex: 1; background: white; border-radius: 8px; padding: 20px;
        border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .timeline-header {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;
    }
    .tahap-badge {
        background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white;
        padding: 4px 12px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;
        text-transform: uppercase;
    }
    .tanggal { color: #64748b; font-size: 0.85rem; font-weight: 500; }

    .catatan { color: #334155; line-height: 1.6; margin-bottom: 15px; }
    
    .foto-preview img {
        max-width: 180px; border-radius: 6px; border: 1px solid #e2e8f0; cursor: pointer;
    }

    .timeline-footer {
        display: flex; gap: 10px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #f1f5f9;
    }
    .btn-aksi {
        display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px;
        border-radius: 4px; font-size: 0.85rem; font-weight: 500; text-decoration: none;
        border: 1px solid transparent; cursor: pointer;
    }
    .btn-edit { background: #fff; border-color: #cbd5e1; color: #334155; }
    .btn-edit:hover { background: #f8fafc; }
    .btn-hapus { background: #fff; border-color: #fca5a5; color: #dc2626; }
    .btn-hapus:hover { background: #fef2f2; }
    .form-hapus { display: inline; margin: 0; }

    .empty-state { text-align: center; color: #94a3b8; padding: 40px; border: 2px dashed #e2e8f0; border-radius: 8px; }
    .empty-state i { font-size: 48px; margin-bottom: 15px; color: #cbd5e1; }
    
    .btn-tambah-kosong {
        display: inline-block; padding: 8px 16px; background: #e2e8f0; color: #475569;
        text-decoration: none; border-radius: 4px; font-size: 0.9rem; font-weight: 600;
    }

    /* Modal */
    .modal {
        display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.8); z-index: 1000; align-items: center; justify-content: center;
    }
    .modal-content { position: relative; max-width: 90%; max-height: 90vh; }
    .modal-content img { max-width: 100%; max-height: 90vh; border-radius: 4px; }
    .modal-close { position: absolute; top: -40px; right: 0; background: none; border: none; color: white; font-size: 30px; cursor: pointer; }

    @media (max-width: 768px) {
        .header-top { flex-direction: column; align-items: flex-start; gap: 15px; }
        .info-card { flex-direction: column; gap: 15px; }
    }
</style>

<script>
function konfirmasiHapusProgres(button) {
    if (confirm('Yakin ingin menghapus progres ini?')) button.closest('.form-hapus').submit();
}
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').style.display = 'flex';
}
function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}
</script>

@endsection