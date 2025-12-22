@extends('layout.master')

@section('title', 'Edit Pesanan')

@section('content')

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Pesanan</h2>
        <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="form-wrapper">
        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>Data Pesanan</h3>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nama Pesanan</label>
                        <input type="text" name="nama_pesanan" class="form-input" value="{{ $pesanan->nama_pesanan }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input">
                            <option value="menunggu" {{ $pesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses" {{ $pesanan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Tanggal Mulai {{ $pesanan->tanggal_mulai && $pesanan->status != 'menunggu' ? '(AKTUAL)' : '(PERKIRAAN)' }}</label>
                        <input type="date" name="tanggal_mulai" class="form-input" value="{{ $pesanan->tanggal_mulai }}">
                        @if($pesanan->tanggal_mulai && $pesanan->status == 'proses')
                            <small class="text-success mt-1 d-block"><i class="fas fa-check-circle me-1"></i> Tanggal ini dicatat otomatis saat status diubah menjadi PROSES.</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Selesai {{ $pesanan->tanggal_selesai && $pesanan->status == 'selesai' ? '(AKTUAL)' : '(PERKIRAAN)' }}</label>
                        <input type="date" name="tanggal_selesai" class="form-input" value="{{ $pesanan->tanggal_selesai }}">
                        @if($pesanan->tanggal_selesai && $pesanan->status == 'selesai')
                            <small class="text-success mt-1 d-block"><i class="fas fa-check-circle me-1"></i> Tanggal ini dicatat otomatis saat status diubah menjadi SELESAI.</small>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-textarea">{{ $pesanan->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Biaya Jasa (Rp)</label>
                    <input type="number" name="biaya_jasa" class="form-input" value="{{ $pesanan->biaya_jasa }}">
                </div>
            </div>

            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-box"></i>
                    <h3>Bahan yang Sudah Digunakan</h3>
                </div>

                @if($pesanan->bahanDipakai->count() > 0)
                <div class="table-container">
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th>Nama Bahan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->bahanDipakai as $pb)
                            <tr>
                                <td>{{ $pb->bahan->nama }}</td>
                                <td>{{ $pb->jumlah }} {{ $pb->bahan->satuan }}</td>
                                <td>Rp {{ number_format($pb->bahan->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($pb->jumlah * $pb->bahan->harga, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Belum ada bahan digunakan.</p>
                </div>
                @endif
            </div>

            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-plus-circle"></i>
                    <h3>Tambah Bahan Tambahan (Opsional)</h3>
                </div>

                <div class="table-container">
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th>Bahan</th>
                                <th>Stok</th>
                                <th>Jumlah Pakai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bahan as $b)
                            <tr>
                                <td>
                                    {{ $b->nama }} ({{ $b->satuan }})
                                    <input type="hidden" name="bahan_id[]" value="{{ $b->id }}">
                                </td>
                                <td>{{ $b->stok }}</td>
                                <td>
                                    <input type="number" name="jumlah[]" class="form-input-small" min="0" placeholder="0">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ... (Semua CSS dari edit.blade.php Anda yang lain) ... */
    .form-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    /* Header */
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
    
    /* Form Wrapper */
    .form-wrapper {
        background: white;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    
    /* Form Sections */
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
    
    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 25px;
    }
    
    /* Form Groups */
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
    
    select.form-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    
    .form-input-small {
        width: 100px;
        padding: 8px 12px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.9rem;
        text-align: center;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-input-small:focus {
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
    
    /* Table */
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
        margin: 0;
    }
    
    /* Form Actions */
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
    
    /* Responsive */
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