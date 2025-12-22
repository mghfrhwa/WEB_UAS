@extends('layout.master')

@section('content')
<div class="pesanan-container">
    <div class="pesanan-header">
        <h2><i class="fas fa-clipboard-list"></i> Data Pesanan</h2>
        <a href="{{ route('pesanan.create') }}" class="btn-tambah">
            <i class="fas fa-plus"></i> Tambah Pesanan
        </a>
    </div>

    <div class="pesanan-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pesanan</th>
                    <th>Kode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td class="nama-pesanan">{{ $p->nama_pesanan }}</td>
                    <td><span class="kode-badge">{{ $p->kode_pesanan }}</span></td>
                    <td>
                        <span class="status-badge status-{{ strtolower($p->status) }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="aksi-group">
                        <a href="{{ route('progres.listByPesanan', $p->id) }}" class="btn-aksi btn-progres" title="Lihat Progres">
                            <i class="fas fa-chart-line"></i>
                        </a>
                        <a href="{{ route('pesanan.show', $p->id) }}" class="btn-aksi btn-lihat" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('pesanan.edit', $p->id) }}" class="btn-aksi btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-aksi btn-hapus" onclick="konfirmasiHapus(this)" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .pesanan-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .pesanan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px; /* Sedikit dikurangi agar lebih padat */
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .pesanan-header h2 {
        font-size: 1.8rem;
        color: #2d3748;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .pesanan-header h2 i {
        color: #4f46e5;
    }
    
    /* Tombol Tambah: Warna Tetap, Efek Gerak Dihapus */
    .btn-tambah {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 10px 20px;
        border-radius: 8px; /* Radius sedikit dikurangi agar lebih formal */
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        /* Shadow lebih tipis */
        box-shadow: 0 2px 5px rgba(79, 70, 229, 0.2); 
    }
    
    .btn-tambah:hover {
        /* Hapus transform translateY */
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        text-decoration: none;
        color: white;
        opacity: 0.95;
    }
    
    .pesanan-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        /* Shadow sangat tipis untuk kesan bersih/formal */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); 
        border: 1px solid #e9ecef;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    thead {
        background: #f8f9fa; /* Warna solid terang, lebih formal dari gradient */
        border-bottom: 2px solid #e9ecef;
    }
    
    th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #4a5568; /* Warna teks sedikit lebih gelap */
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    td {
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        color: #4a5568;
        vertical-align: middle;
    }
    
    tr:hover {
        background-color: #fafafa;
    }
    
    .nama-pesanan {
        font-weight: 600;
        color: #2d3748;
    }
    
    .kode-badge {
        background: #f8fafc;
        color: #475569;
        padding: 6px 10px;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid #e2e8f0;
    }
    
    /* Status Badges: Warna Asli Dipertahankan */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        text-transform: capitalize;
    }
    
    .status-menunggu {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    
    .status-proses, .status-processing, .status-diproses {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }
    
    .status-selesai, .status-completed, .status-done {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .status-dibatalkan, .status-canceled {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    
    .aksi-group {
        display: flex;
        gap: 6px; /* Jarak antar tombol diperkecil sedikit */
        align-items: center;
    }
    
    /* Tombol Aksi: Hapus efek melayang */
    .btn-aksi {
        width: 34px;
        height: 34px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background 0.2s;
    }
    
    .btn-progres {
        background: #f0f9ff;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }
    .btn-progres:hover {
        background: #e0f2fe;
        color: #0284c7;
    }
    
    .btn-lihat {
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .btn-lihat:hover {
        background: #dcfce7;
        color: #15803d;
    }
    
    .btn-edit {
        background: #fef7ff;
        color: #a855f7;
        border: 1px solid #e9d5ff;
    }
    .btn-edit:hover {
        background: #f3e8ff;
        color: #9333ea;
    }
    
    .btn-hapus {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .btn-hapus:hover {
        background: #fee2e2;
        color: #b91c1c;
    }
    
    .form-hapus {
        display: inline;
        margin: 0;
    }
    
    /* Responsif */
    @media (max-width: 768px) {
        .pesanan-container {
            padding: 0 15px;
            margin: 20px auto;
        }
        
        .pesanan-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .pesanan-header h2 {
            font-size: 1.5rem;
        }
        
        .btn-tambah {
            width: 100%;
            justify-content: center;
        }
        
        .pesanan-table {
            overflow-x: auto;
        }
        
        table {
            min-width: 600px;
        }
        
        .aksi-group {
            flex-wrap: wrap;
        }
    }
</style>

<script>
function konfirmasiHapus(button) {
    if (confirm('Yakin ingin menghapus pesanan ini?')) {
        button.closest('.form-hapus').submit();
    }
}
/* Script animasi baris dihapus untuk tampilan yang lebih cepat dan formal */
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection