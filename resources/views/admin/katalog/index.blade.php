@extends('layout.master')

@section('title', 'Katalog Mesin')

@section('content')

<div class="katalog-container">
    <div class="katalog-header">
        <h2><i class="fas fa-cogs"></i> Katalog Mesin</h2>
        <button class="btn-tambah" onclick="openCreateModal()">
            <i class="fas fa-plus"></i> Tambah Mesin
        </button>
    </div>

    <div class="katalog-grid">
        @foreach($katalog as $k)
        <div class="mesin-card">
            <div class="card-image">
                @if($k->foto)
                <img src="{{ asset('storage/' . $k->foto) }}" 
                     alt="{{ $k->judul }}"
                     onclick="openImageModal('{{ asset('storage/' . $k->foto) }}')">
                @else
                <div class="no-image">
                    <i class="fas fa-camera"></i>
                    <span>Tidak ada foto</span>
                </div>
                @endif
            </div>
            
            <div class="card-content">
                <div class="card-header">
                    <h3 class="judul">{{ $k->judul }}</h3>
                    <span class="harga">Rp {{ number_format($k->harga, 0, ',', '.') }}</span>
                </div>
                
                <p class="deskripsi">{{ $k->deskripsi }}</p>
                
                <div class="card-footer">
                    <button class="btn-aksi btn-edit"
                            onclick="openEditModal(
                                {{ $k->id }},
                                '{{ addslashes($k->judul) }}',
                                `{{ addslashes($k->deskripsi) }}`,
                                '{{ $k->harga }}'
                            )">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </button>
                    
                    <form action="{{ route('katalog.destroy', $k->id) }}"
                          method="POST"
                          class="form-hapus">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                class="btn-aksi btn-hapus"
                                onclick="konfirmasiHapus(this, '{{ addslashes($k->judul) }}')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($katalog->isEmpty())
    <div class="empty-state">
        <i class="fas fa-cube"></i>
        <h3>Data Kosong</h3>
        <p>Belum ada data mesin yang tersimpan.</p>
    </div>
    @endif
</div>

<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus-square"></i> Tambah Mesin Baru</h3>
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>
        </div>
        
        <form action="{{ route('katalog.store') }}" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf

            <div class="form-group">
                <label for="judul">Judul Mesin</label>
                <input type="text" id="judul" name="judul" required placeholder="Nama mesin...">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Spesifikasi mesin..."></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="harga" name="harga" required>
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <div class="file-input-wrapper">
                    <input type="file" id="foto" name="foto" accept="image/*" class="form-control-file">
                    <small class="form-text">Format: JPG/PNG, Maks: 2MB</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-simpan">Simpan Data</button>
                <button type="button" class="btn-batal" onclick="closeCreateModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Data Mesin</h3>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        
        <form id="editForm" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf
            @method('PUT')
            <input type="hidden" id="routeTemplate" value="{{ route('katalog.update', ['id' => ':id']) }}">

            <div class="form-group">
                <label for="editJudul">Judul Mesin</label>
                <input type="text" id="editJudul" name="judul" required>
            </div>

            <div class="form-group">
                <label for="editDeskripsi">Deskripsi</label>
                <textarea id="editDeskripsi" name="deskripsi"></textarea>
            </div>

            <div class="form-group">
                <label for="editHarga">Harga</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="editHarga" name="harga" required>
                </div>
            </div>

            <div class="form-group">
                <label for="editFoto">Foto Baru</label>
                <div class="file-input-wrapper">
                    <input type="file" id="editFoto" name="foto" accept="image/*" class="form-control-file">
                    <small class="form-text">Biarkan kosong jika tidak ingin mengubah foto</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                <button type="button" class="btn-batal" onclick="closeEditModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="imageModal">
    <div class="modal-content image-preview-content">
        <button class="modal-close" onclick="closeImageModal()">&times;</button>
        <img id="modalImage" src="" alt="Preview Foto">
    </div>
</div>

<style>
    /* Reset & Base */
    .katalog-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
    
    /* Header Section */
    .katalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #cbd5e1;
    }
    
    .katalog-header h2 {
        font-size: 1.5rem;
        color: #1e293b;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .katalog-header h2 i { color: #059669; }
    
    /* Tombol Utama (Warna Hijau Gradient - Dikembalikan) */
    .btn-tambah {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2);
    }
    
    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(5, 150, 105, 0.3);
    }
    
    /* Grid Layout */
    .katalog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    /* Kartu Mesin */
    .mesin-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px; /* Radius lembut */
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s;
    }
    
    .mesin-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        border-color: #cbd5e1;
    }
    
    /* Bagian Foto (Ditengahkan dengan Padding) */
    .card-image {
        height: 220px;
        padding: 15px; /* Memberi jarak agar foto 'ditengahkan' */
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px; /* Sudut foto melengkung */
        box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Bayangan tipis pada foto */
        cursor: pointer;
        transition: transform 0.2s;
    }

    .card-image img:hover {
        transform: scale(1.02);
    }
    
    .no-image {
        width: 100%; height: 100%;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        color: #94a3b8; gap: 8px;
        background: #f8fafc;
        border-radius: 8px;
    }
    .no-image i { font-size: 32px; }
    
    .card-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
        gap: 10px;
    }
    
    .judul {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.4;
    }
    
    /* Harga Tag (Warna Hijau Gradient - Dikembalikan) */
    .harga {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(5, 150, 105, 0.2);
    }
    
    .deskripsi {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 20px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .card-footer {
        display: flex;
        gap: 10px;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    
    /* Tombol Aksi (Warna Lembut) */
    .btn-aksi {
        flex: 1;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-edit {
        background-color: #f0f9ff;
        color: #0369a1;
        border-color: #bae6fd;
    }
    .btn-edit:hover {
        background-color: #0ea5e9;
        color: white;
        border-color: #0ea5e9;
    }
    
    .btn-hapus {
        background-color: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .btn-hapus:hover {
        background-color: #dc2626;
        color: white;
        border-color: #dc2626;
    }
    
    .form-hapus { display: inline; margin: 0; flex: 1; display: flex; }
    
    .empty-state {
        text-align: center; padding: 60px 20px;
        border: 2px dashed #e2e8f0; border-radius: 12px;
        color: #94a3b8; background: #f8fafc;
    }
    .empty-state i { font-size: 48px; margin-bottom: 15px; color: #cbd5e1; }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center; justify-content: center;
        backdrop-filter: blur(3px);
    }
    
    .modal-content {
        background: white;
        border-radius: 12px;
        width: 95%; max-width: 500px; max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    .modal-header {
        display: flex; justify-content: space-between; align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .modal-header h3 { margin: 0; color: #1e293b; font-size: 1.2rem; display: flex; align-items: center; gap: 10px; }
    .modal-close { background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer; }
    
    .modal-form { padding: 25px; }
    
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 0.9rem; }
    
    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea {
        width: 100%; padding: 10px 15px;
        border: 1px solid #cbd5e1; border-radius: 8px;
        font-size: 0.95rem;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group textarea:focus {
        outline: none; border-color: #059669; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .input-group { display: flex; }
    .input-group-text {
        background: #f8fafc; border: 1px solid #cbd5e1; border-right: none;
        padding: 10px 15px; color: #64748b; font-weight: 600; border-radius: 8px 0 0 8px;
    }
    .input-group input { border-radius: 0 8px 8px 0; }
    
    .form-text { display: block; margin-top: 5px; color: #94a3b8; font-size: 0.85rem; }
    
    .modal-footer {
        display: flex; justify-content: flex-end; gap: 10px;
        padding: 20px 25px; border-top: 1px solid #e2e8f0; background: #f8fafc;
    }
    
    .btn-simpan {
        background: linear-gradient(135deg, #059669, #10b981); color: white; border: none;
        padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;
    }
    .btn-batal {
        background: white; border: 1px solid #cbd5e1; color: #475569;
        padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;
    }

    /* Image Preview Modal */
    .image-preview-content {
        width: auto; max-width: 90%; background: transparent; box-shadow: none; border: none;
    }
    #modalImage { max-width: 100%; max-height: 85vh; border-radius: 8px; border: 4px solid white; box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
    
    /* Responsif */
    @media (max-width: 768px) {
        .katalog-header { flex-direction: column; align-items: flex-start; gap: 15px; }
        .btn-tambah { width: 100%; justify-content: center; }
        .katalog-grid { grid-template-columns: 1fr; }
    }
</style>

<script>
function openCreateModal() { document.getElementById('createModal').style.display = 'flex'; }
function closeCreateModal() { document.getElementById('createModal').style.display = 'none'; }

function openEditModal(id, judul, deskripsi, harga) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('editJudul').value = judul;
    document.getElementById('editDeskripsi').value = deskripsi;
    document.getElementById('editHarga').value = harga;
    // Javascript untuk mengubah URL action form secara dinamis sesuai ID
    let template = document.getElementById('routeTemplate').value;
    document.getElementById('editForm').action = template.replace(':id', id);
}
function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }

function konfirmasiHapus(button, judul) {
    if (confirm(`Hapus mesin "${judul}" dari katalog?`)) {
        button.closest('.form-hapus').submit();
    }
}

function openImageModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModal').style.display = 'flex';
}
function closeImageModal() { document.getElementById('imageModal').style.display = 'none'; }

// Close modal on click outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
}
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection