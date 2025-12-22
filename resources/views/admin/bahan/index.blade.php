@extends('layout.master')

@section('title', 'Data Bahan')

@section('content')

<div class="bahan-container">
    <div class="bahan-header">
        <div class="header-title">
            <h2><i class="fas fa-boxes"></i> Data Bahan</h2>
        </div>
        
        <div class="header-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama bahan...">
            </div>
            <button class="btn-pdf" onclick="exportPDF()">
                <i class="fas fa-file-pdf"></i> PDF
            </button>

            <button class="btn-tambah" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>

    <div class="bahan-table">
        <table id="tableBahan">
            <thead>
                <tr>
                    {{-- Header dibuat lebih teknis --}}
                    <th class="text-center" width="5%">ID</th>
                    <th width="25%">Nama Bahan</th>
                    <th class="text-center" width="10%">Satuan</th>
                    <th class="text-right" width="10%">Stok</th>
                    <th class="text-right" width="15%">Harga Satuan</th>
                    <th width="25%">Keterangan</th>
                    <th class="text-center" width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bahan as $b)
                <tr>
                    <td class="text-center font-mono text-muted">#{{ $b->id }}</td>
                    <td class="nama-bahan">{{ $b->nama }}</td>
                    <td class="text-center"><span class="satuan-tag">{{ $b->satuan }}</span></td>
                    <td class="text-right">
                        {{-- Stok menggunakan font mono agar angka sejajar --}}
                        <span class="stok-text {{ $b->stok <= 10 ? 'text-danger' : '' }}">
                            {{ $b->stok }}
                        </span>
                    </td>
                    <td class="text-right harga font-mono">Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td class="keterangan">{{ $b->keterangan ?? '-' }}</td>
                    <td class="aksi-group text-center">
                        <button class="btn-aksi btn-edit" 
                                onclick="openEditModal({{ $b->id }}, '{{ $b->nama }}', '{{ $b->satuan }}', '{{ $b->stok }}', '{{ $b->harga }}', '{{ addslashes($b->keterangan) }}')"
                                title="Edit Bahan">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <form action="{{ route('bahan.destroy', $b->id) }}" method="POST" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-aksi btn-hapus" 
                                    onclick="konfirmasiHapus(this, '{{ addslashes($b->nama) }}')"
                                    title="Hapus Bahan">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus"></i> Tambah Bahan</h3>
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>
        </div>
        
        <form action="{{ route('bahan.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Bahan</label>
                <input type="text" id="nama" name="nama" required placeholder="Masukkan nama bahan">
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" id="satuan" name="satuan" required placeholder="Contoh: kg, pcs, liter">
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" id="stok" name="stok" required placeholder="Jumlah stok tersedia">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="harga" name="harga" required placeholder="Harga per satuan">
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" placeholder="Tambahkan keterangan (opsional)"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-simpan">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="btn-batal" onclick="closeCreateModal()">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Bahan</h3>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        
        <form id="editForm" method="POST" class="modal-form">
            @csrf
            @method('PUT')
            <input type="hidden" id="updateRouteTemplate" value="{{ route('bahan.update', ['id' => ':id']) }}">

            <div class="form-group">
                <label for="editNama">Nama Bahan</label>
                <input type="text" id="editNama" name="nama" required placeholder="Masukkan nama bahan">
            </div>
            <div class="form-group">
                <label for="editSatuan">Satuan</label>
                <input type="text" id="editSatuan" name="satuan" required placeholder="Contoh: kg, pcs, liter">
            </div>
            <div class="form-group">
                <label for="editStok">Stok</label>
                <input type="number" id="editStok" name="stok" required placeholder="Jumlah stok tersedia">
            </div>
            <div class="form-group">
                <label for="editHarga">Harga</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="editHarga" name="harga" required placeholder="Harga per satuan">
                </div>
            </div>
            <div class="form-group">
                <label for="editKeterangan">Keterangan</label>
                <textarea id="editKeterangan" name="keterangan" placeholder="Tambahkan keterangan (opsional)"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-simpan">
                    <i class="fas fa-save"></i> Update
                </button>
                <button type="button" class="btn-batal" onclick="closeEditModal()">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* === CONTAINER & HEADER (Gaya Asli Dipertahankan) === */
    .bahan-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .bahan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .bahan-header h2 {
        font-size: 1.8rem;
        color: #2d3748;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    
    .bahan-header h2 i { color: #059669; }

    /* Search Box */
    .search-box { position: relative; }
    .search-box input {
        padding: 10px 15px 10px 35px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        width: 200px;
        transition: all 0.3s;
    }
    .search-box input:focus {
        outline: none; border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1); width: 240px;
    }
    .search-box i {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%); color: #9ca3af; font-size: 0.9rem;
    }
    
    /* Tombol-tombol Asli */
    .btn-pdf {
        background: #ef4444; color: white; padding: 12px 18px;
        border-radius: 10px; border: none; font-weight: 600;
        display: flex; align-items: center; gap: 8px; cursor: pointer;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2); transition: 0.3s;
    }
    .btn-pdf:hover { background: #dc2626; transform: translateY(-2px); }
    
    .btn-tambah {
        background: linear-gradient(135deg, #059669, #10b981); color: white;
        padding: 12px 24px; border-radius: 10px; border: none; font-weight: 600;
        display: flex; align-items: center; gap: 8px; cursor: pointer;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3); transition: 0.3s;
    }
    .btn-tambah:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4); }

    /* === BAGIAN TABEL (DIPERBARUI AGAR LEBIH FOKUS DATA) === */
    .bahan-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); /* Shadow lebih halus */
        border: 1px solid #e2e8f0;
    }
    
    table {
        width: 100%;
        border-collapse: collapse; /* Menghilangkan jarak antar sel */
    }
    
    /* Header Tabel: Lebih bersih dan teknis */
    thead {
        background-color: #f8fafc; /* Abu-abu sangat muda */
        border-bottom: 2px solid #e2e8f0;
    }
    
    th {
        padding: 15px;
        color: #64748b; /* Warna teks abu-abu tua */
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px; /* Jarak antar huruf */
    }
    
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f5f9; /* Garis pemisah tipis */
        color: #334155;
        vertical-align: middle;
        font-size: 0.95rem;
    }
    
    /* Baris Tabel: Efek Zebra & Hover */
    tr:hover { background-color: #f8fafc; }
    
    /* Typography Data */
    .font-mono {
        font-family: 'Consolas', 'Monaco', monospace; /* Font koding untuk angka */
        letter-spacing: -0.5px;
    }
    
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    .text-muted { color: #94a3b8; font-size: 0.85rem; }
    .text-danger { color: #dc2626; font-weight: bold; }

    /* Styling Konten Tabel */
    .nama-bahan {
        font-weight: 600;
        color: #0f172a;
    }
    
    .satuan-tag {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        border: 1px solid #e2e8f0;
    }
    
    .stok-text {
        font-weight: 700;
        font-size: 0.95rem;
    }
    
    .harga {
        color: #0f172a;
    }
    
    .keterangan {
        color: #64748b;
        font-size: 0.85rem;
        font-style: italic;
    }
    
    /* Tombol Aksi dalam Tabel */
    .aksi-group {
        display: flex;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-aksi {
        width: 32px;
        height: 32px;
        border-radius: 6px; /* Lebih kotak dikit */
        display: flex; align-items: center; justify-content: center;
        border: none; cursor: pointer; transition: 0.2s;
    }
    
    .btn-edit { background: white; border: 1px solid #bae6fd; color: #0284c7; }
    .btn-edit:hover { background: #e0f2fe; }
    
    .btn-hapus { background: white; border: 1px solid #fecaca; color: #dc2626; }
    .btn-hapus:hover { background: #fee2e2; }
    
    .form-hapus { display: inline; margin: 0; }
    
    /* === MODAL STYLES (ASLI) === */
    .modal {
        display: none; position: fixed; top: 0; left: 0;
        width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px); z-index: 1000;
        align-items: center; justify-content: center;
        animation: fadeIn 0.3s ease;
    }
    
    .modal-content {
        background: white; border-radius: 16px; width: 90%;
        max-width: 500px; max-height: 90vh; overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); animation: slideUp 0.3s ease;
    }
    
    .modal-header {
        display: flex; justify-content: space-between; align-items: center;
        padding: 25px 30px; border-bottom: 1px solid #e9ecef;
    }
    
    .modal-header h3 { margin: 0; color: #2d3748; font-size: 1.3rem; display: flex; align-items: center; gap: 10px; }
    .modal-close { background: none; border: none; font-size: 28px; color: #9ca3af; cursor: pointer; }
    
    .modal-form { padding: 30px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #374151; font-size: 0.9rem; }
    .form-group input, .form-group textarea {
        width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb;
        border-radius: 10px; font-size: 0.95rem; transition: border-color 0.3s;
    }
    .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #059669; }
    .input-group { display: flex; align-items: center; }
    .input-group-text {
        background: #f3f4f6; border: 2px solid #e5e7eb; border-right: none;
        padding: 12px 15px; border-radius: 10px 0 0 10px; font-weight: 600; color: #374151;
    }
    .input-group input { border-radius: 0 10px 10px 0; }
    
    .modal-footer {
        display: flex; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;
    }
    .btn-simpan {
        flex: 1; background: linear-gradient(135deg, #059669, #10b981); color: white;
        padding: 14px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;
    }
    .btn-batal {
        flex: 1; background: #f3f4f6; color: #6b7280; padding: 14px;
        border: 2px solid #e5e7eb; border-radius: 10px; font-weight: 600; cursor: pointer;
    }
    
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Responsive Updates */
    @media (max-width: 768px) {
        .header-actions { width: 100%; flex-direction: column; align-items: stretch; }
        .search-box input { width: 100%; }
        .search-box input:focus { width: 100%; }
        .bahan-table { overflow-x: auto; }
        table { min-width: 600px; }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<script>
// --- FITUR PENCARIAN & EXPORT ---
function filterTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("tableBahan");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        let tdNama = tr[i].getElementsByTagName("td")[1];
        let tdKet = tr[i].getElementsByTagName("td")[5];
        
        if (tdNama || tdKet) {
            let txtValueNama = tdNama.textContent || tdNama.innerText;
            let txtValueKet = tdKet.textContent || tdKet.innerText;
            
            if (txtValueNama.toLowerCase().indexOf(filter) > -1 || txtValueKet.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function exportPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Laporan Data Bahan", 14, 15);
    doc.setFontSize(10);
    doc.text("Dicetak pada: " + new Date().toLocaleString(), 14, 22);

    doc.autoTable({
        html: '#tableBahan',
        startY: 30,
        theme: 'grid',
        columns: [0, 1, 2, 3, 4, 5],
        headStyles: { fillColor: [5, 150, 105] },
        styles: { fontSize: 8, cellPadding: 3 },
        columnStyles: {
            3: { halign: 'right' }, 
            4: { halign: 'right' }  
        }
    });

    doc.save('Data-Bahan.pdf');
}

// --- LOGIKA MODAL 
function openCreateModal() { document.getElementById('createModal').style.display = 'flex'; }
function closeCreateModal() { document.getElementById('createModal').style.display = 'none'; }

function openEditModal(id, nama, satuan, stok, harga, ket) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('editNama').value = nama;
    document.getElementById('editSatuan').value = satuan;
    document.getElementById('editStok').value = stok;
    document.getElementById('editHarga').value = harga;
    document.getElementById('editKeterangan').value = ket;

    let template = document.getElementById('updateRouteTemplate').value;
    document.getElementById('editForm').action = template.replace(':id', id);
}

function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }

function konfirmasiHapus(button, namaBahan) {
    if (confirm(`Yakin ingin menghapus bahan "${namaBahan}"?`)) {
        button.closest('.form-hapus').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    });
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection