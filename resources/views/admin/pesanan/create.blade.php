@extends('layout.master')

@section('title', 'Tambah Pesanan')

@section('content')

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-plus-circle"></i> Tambah Pesanan</h2>
        <a href="{{ route('pesanan.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="form-wrapper">
        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf

            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>Data Pesanan</h3>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Pesanan</label>
                    <input type="text" name="nama_pesanan" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-textarea"></textarea>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Perkiraan Tanggal Mulai (Opsional)</label>
                        <input type="date" name="tanggal_mulai" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Perkiraan Tanggal Selesai (Opsional)</label>
                        <input type="date" name="tanggal_selesai" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Biaya Jasa Pengerjaan (Rp)</label>
                    <input type="number" name="biaya_jasa" class="form-input" min="0" value="0">
                </div>
            </div>

            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-box"></i>
                    <h3>Bahan yang Digunakan</h3>
                </div>

                <div class="bahan-form-panel"> <div class="table-container">
                        <table class="form-table">
                            <thead>
                                <tr>
                                    <th>Bahan</th>
                                    <th>Harga Satuan</th>
                                    <th>Stok Tersedia</th>
                                    <th class="text-center">Jumlah Dipakai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bahan as $b)
                                <tr>
                                    <td>
                                        <span class="bahan-nama">{{ $b->nama }}</span> 
                                        <span class="bahan-satuan">({{ $b->satuan }})</span>
                                        <input type="hidden" name="bahan_id[]" value="{{ $b->id }}">
                                    </td>
                                    <td><span class="bahan-harga">Rp {{ number_format($b->harga, 0, ',', '.') }}</span></td>
                                    <td><span class="bahan-stok">{{ $b->stok }}</span></td>
                                    <td class="text-center">
                                        <input type="number" name="jumlah[]" class="form-input-small" min="0" max="{{ $b->stok }}" placeholder="0">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="alert-info-bahan">
                    <i class="fas fa-info-circle me-1"></i> Masukkan jumlah bahan yang akan digunakan untuk pesanan ini. Stok akan dikurangi setelah pesanan disimpan.
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Pesanan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ================================================= */
    /* === STYLING KHUSUS UNTUK BAHAN (FORM DI DALAM FORM) === */
    /* ================================================= */

    .bahan-form-panel {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        background: #fdfdfe; /* Slightly off-white background */
        padding: 1px;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); /* Inner shadow for depth */
        margin-bottom: 20px;
    }

    .bahan-nama {
        font-weight: 600;
        color: #374151;
    }
    .bahan-satuan {
        color: #6b7280;
        font-style: italic;
        font-size: 0.85rem;
    }
    .bahan-harga {
        font-weight: 500;
        color: #059669; /* Green color for price */
    }
    .bahan-stok {
        font-weight: 600;
        color: #1e40af; /* Blue color for stock */
    }
    
    .form-table th, .form-table td {
        padding: 12px 15px; /* Kurangi padding tabel agar lebih padat */
        font-size: 0.95rem;
    }
    
    .form-input-small {
        width: 80px; /* Lebar input lebih kecil */
        text-align: center;
        padding: 8px 10px;
    }
    
    .alert-info-bahan {
        background: #eef2ff;
        color: #4f46e5;
        padding: 12px;
        border-left: 4px solid #4f46e5;
        border-radius: 6px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ================================================= */
    /* === STYLING UTAMA (Tetap sama seperti form lain) === */
    /* ================================================= */
    .form-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .form-header h2 {
        font-size: 1.8rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    
    .form-header h2 i {
        color: #4f46e5;
    }
    
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
        text-decoration: none;
        color: white;
    }
    
    .form-wrapper {
        background: white;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    
    .form-section {
        padding: 30px;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .form-section:last-child {
        border-bottom: none;
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
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 25px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group:last-child {
        margin-bottom: 0;
    }
    
    .form-label {
        display: block;
        font-size: 0.95rem;
        color: #374151;
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        color: #374151;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        color: #374151;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-textarea:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }
    
    .form-table thead {
        background: #f8fafc;
    }
    
    .form-table th {
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.9rem;
    }
    
    .form-table td {
        padding: 15px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #4b5563;
        vertical-align: middle;
    }
    
    .form-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .form-actions {
        padding: 30px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        text-align: right;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #5b54ee, #8b5cf6);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    
    @media (max-width: 768px) {
        .form-container {
            margin: 20px auto;
            padding: 0 15px;
        }
        
        .form-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .form-section {
            padding: 20px;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .form-actions {
            padding: 20px;
            text-align: center;
        }
        
        .btn-primary {
            width: 100%;
            justify-content: center;
        }
        
        .form-input-small {
            width: 80px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection