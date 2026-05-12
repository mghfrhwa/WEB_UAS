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

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="form-wrapper">
        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ==================== SECTION 1: DATA PESANAN ==================== --}}
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>Data Pesanan</h3>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nama Pesanan</label>
                        <input type="text" name="nama_pesanan" class="form-input"
                               value="{{ old('nama_pesanan', $pesanan->nama_pesanan) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status Pesanan</label>
                        <select name="status" class="form-input">
                            <option value="menunggu" {{ $pesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses"   {{ $pesanan->status == 'proses'   ? 'selected' : '' }}>Proses</option>
                            <option value="selesai"  {{ $pesanan->status == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            Tanggal Mulai
                            <span class="label-badge {{ ($pesanan->tanggal_mulai && $pesanan->status != 'menunggu') ? 'badge-actual' : 'badge-estimate' }}">
                                {{ ($pesanan->tanggal_mulai && $pesanan->status != 'menunggu') ? 'AKTUAL' : 'PERKIRAAN' }}
                            </span>
                        </label>
                        <input type="date" name="tanggal_mulai" class="form-input"
                               value="{{ old('tanggal_mulai', $pesanan->tanggal_mulai) }}">
                        @if($pesanan->tanggal_mulai && $pesanan->status == 'proses')
                            <small class="hint-success"><i class="fas fa-check-circle"></i> Dicatat otomatis saat status diubah ke PROSES.</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Tanggal Selesai
                            <span class="label-badge {{ ($pesanan->tanggal_selesai && $pesanan->status == 'selesai') ? 'badge-actual' : 'badge-estimate' }}">
                                {{ ($pesanan->tanggal_selesai && $pesanan->status == 'selesai') ? 'AKTUAL' : 'PERKIRAAN' }}
                            </span>
                        </label>
                        <input type="date" name="tanggal_selesai" class="form-input"
                               value="{{ old('tanggal_selesai', $pesanan->tanggal_selesai) }}">
                        @if($pesanan->tanggal_selesai && $pesanan->status == 'selesai')
                            <small class="hint-success"><i class="fas fa-check-circle"></i> Dicatat otomatis saat status diubah ke SELESAI.</small>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-textarea">{{ old('deskripsi', $pesanan->deskripsi) }}</textarea>
                </div>
            </div>

            {{-- ==================== SECTION 2: DATA PEMBAYARAN ==================== --}}
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>Data Pembayaran</h3>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Biaya Jasa (Rp)</label>
                        <div class="input-prefix-wrapper">
                            <span class="input-prefix">Rp</span>
                            <input type="number" name="biaya_jasa" id="biaya_jasa" class="form-input with-prefix"
                                   value="{{ old('biaya_jasa', $pesanan->biaya_jasa) }}" min="0" placeholder="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga Total (Rp)
                            <span class="label-hint">Biaya jasa + bahan</span>
                        </label>
                        <div class="input-prefix-wrapper">
                            <span class="input-prefix">Rp</span>
                            <input type="number" name="harga_total" id="harga_total" class="form-input with-prefix"
                                   value="{{ old('harga_total', $pesanan->harga_total ?? 0) }}" min="0" placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Jumlah DP (Rp)</label>
                        <div class="input-prefix-wrapper">
                            <span class="input-prefix">Rp</span>
                            <input type="number" name="jumlah_dp" id="jumlah_dp" class="form-input with-prefix"
                                   value="{{ old('jumlah_dp', $pesanan->jumlah_dp ?? 0) }}" min="0" placeholder="0"
                                   oninput="hitungSisa()">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-input">
                            <option value="belum_bayar" {{ old('status_pembayaran', $pesanan->status_pembayaran ?? 'belum_bayar') == 'belum_bayar' ? 'selected' : '' }}>
                                Belum Bayar
                            </option>
                            <option value="dp" {{ old('status_pembayaran', $pesanan->status_pembayaran ?? '') == 'dp' ? 'selected' : '' }}>
                                DP (Uang Muka)
                            </option>
                            <option value="lunas" {{ old('status_pembayaran', $pesanan->status_pembayaran ?? '') == 'lunas' ? 'selected' : '' }}>
                                Lunas
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Ringkasan Pembayaran --}}
                <div class="payment-summary" id="payment-summary">
                    <div class="summary-row">
                        <span class="summary-label"><i class="fas fa-receipt"></i> Harga Total</span>
                        <span class="summary-value" id="sum-total">Rp 0</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label"><i class="fas fa-hand-holding-usd"></i> DP Dibayar</span>
                        <span class="summary-value text-blue" id="sum-dp">Rp 0</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row summary-total">
                        <span class="summary-label"><i class="fas fa-balance-scale"></i> Sisa Tagihan</span>
                        <span class="summary-value text-red" id="sum-sisa">Rp 0</span>
                    </div>
                </div>
            </div>

            {{-- ==================== SECTION 3: BAHAN TERPAKAI ==================== --}}
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
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalBahan = 0; @endphp
                            @foreach($pesanan->bahanDipakai as $pb)
                            @php
                                $subtotal = $pb->jumlah * $pb->bahan->harga;
                                $totalBahan += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $pb->bahan->nama }}</td>
                                <td>{{ $pb->jumlah }} {{ $pb->bahan->satuan }}</td>
                                <td>Rp {{ number_format($pb->bahan->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="tfoot-total">
                                <td colspan="3" style="text-align:right; font-weight:600;">Total Bahan:</td>
                                <td style="font-weight:700; color:#4f46e5;">
                                    Rp {{ number_format($totalBahan, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Belum ada bahan digunakan.</p>
                </div>
                @endif
            </div>

            {{-- ==================== SECTION 4: TAMBAH BAHAN ==================== --}}
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-plus-circle"></i>
                    <h3>Tambah Bahan (Opsional)</h3>
                </div>

                <div class="table-container">
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th>Bahan</th>
                                <th>Stok Tersedia</th>
                                <th>Jumlah Pakai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bahan as $b)
                            <tr>
                                <td>
                                    {{ $b->nama }}
                                    <span class="satuan-badge">{{ $b->satuan }}</span>
                                    <input type="hidden" name="bahan_id[]" value="{{ $b->id }}">
                                </td>
                                <td>
                                    <span class="{{ $b->stok <= 5 ? 'stok-low' : 'stok-ok' }}">
                                        {{ $b->stok }}
                                    </span>
                                </td>
                                <td>
                                    <input type="number" name="jumlah[]" class="form-input-small"
                                           min="0" max="{{ $b->stok }}" placeholder="0">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ==================== FORM ACTIONS ==================== --}}
            <div class="form-actions">
                <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .form-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Alert */
    .alert-success, .alert-error {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.95rem;
    }
    .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .alert-error ul { margin: 0; padding-left: 18px; }

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
    .form-header h2 i { color: #4f46e5; }

    .btn-back {
        background: #6b7280;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.2s;
    }
    .btn-back:hover { background: #4b5563; color: white; text-decoration: none; }

    /* Form Wrapper */
    .form-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    /* Sections */
    .form-section {
        padding: 30px;
        border-bottom: 1px solid #f1f5f9;
    }
    .form-section:last-of-type { border-bottom: none; }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }
    .section-header i { color: #4f46e5; font-size: 1.4rem; }
    .section-header h3 { font-size: 1.2rem; color: #374151; margin: 0; }

    /* Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 25px;
    }

    /* Groups */
    .form-group { margin-bottom: 20px; }
    .form-group:last-child { margin-bottom: 0; }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #374151;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .label-badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 4px;
    }
    .badge-actual   { background: #d1fae5; color: #065f46; }
    .badge-estimate { background: #fef3c7; color: #92400e; }
    .label-hint {
        font-size: 0.75rem;
        font-weight: 400;
        color: #9ca3af;
    }

    .hint-success {
        display: block;
        margin-top: 6px;
        font-size: 0.82rem;
        color: #059669;
    }

    /* Inputs */
    .form-input {
        width: 100%;
        padding: 11px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        color: #374151;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: white;
        box-sizing: border-box;
    }
    .form-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }
    select.form-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    .form-textarea {
        width: 100%;
        padding: 11px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        color: #374151;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }
    .form-textarea:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }

    /* Input dengan prefix Rp */
    .input-prefix-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-prefix {
        position: absolute;
        left: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #6b7280;
        pointer-events: none;
    }
    .form-input.with-prefix { padding-left: 36px; }

    /* Payment Summary Box */
    .payment-summary {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px 24px;
        margin-top: 10px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }
    .summary-label {
        font-size: 0.9rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .summary-label i { width: 16px; text-align: center; }
    .summary-value { font-size: 1rem; font-weight: 600; color: #1f2937; }
    .summary-divider { border-top: 1px dashed #cbd5e1; margin: 8px 0; }
    .summary-total .summary-label { font-size: 1rem; font-weight: 700; color: #374151; }
    .summary-total .summary-value { font-size: 1.1rem; }
    .text-blue { color: #3b82f6 !important; }
    .text-red  { color: #ef4444 !important; }

    /* Form-input-small */
    .form-input-small {
        width: 90px;
        padding: 8px 10px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.9rem;
        text-align: center;
        transition: border-color 0.2s;
    }
    .form-input-small:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }

    /* Table */
    .table-container { overflow-x: auto; }
    .form-table { width: 100%; border-collapse: collapse; min-width: 500px; }
    .form-table thead { background: #f8fafc; }
    .form-table th {
        padding: 13px 14px; text-align: left; font-weight: 600;
        color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 0.88rem;
        text-transform: uppercase; letter-spacing: 0.03em;
    }
    .form-table td {
        padding: 13px 14px; border-bottom: 1px solid #f1f5f9;
        color: #4b5563; vertical-align: middle; font-size: 0.95rem;
    }
    .form-table tbody tr:hover td { background: #fafbff; }
    .form-table tfoot .tfoot-total td {
        padding: 14px; border-top: 2px solid #e5e7eb;
        background: #f8fafc; border-bottom: none;
    }

    /* Badges & Status */
    .satuan-badge {
        display: inline-block;
        background: #ede9fe;
        color: #6d28d9;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 4px;
        margin-left: 6px;
    }
    .stok-ok  { color: #059669; font-weight: 600; }
    .stok-low { color: #dc2626; font-weight: 600; }

    /* Empty State */
    .empty-state { text-align: center; padding: 40px 20px; color: #9ca3af; }
    .empty-state i { font-size: 48px; margin-bottom: 15px; color: #d1d5db; display: block; }
    .empty-state p { font-size: 1rem; margin: 0; }

    /* Form Actions */
    .form-actions {
        padding: 25px 30px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .btn-primary {
        background: #4f46e5;
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.2s;
    }
    .btn-primary:hover { background: #4338ca; }

    .btn-secondary {
        background: white;
        color: #6b7280;
        padding: 12px 22px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-secondary:hover {
        border-color: #9ca3af;
        color: #374151;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container { margin: 20px auto; padding: 0 15px; }
        .form-header { flex-direction: column; align-items: flex-start; gap: 15px; }
        .form-section { padding: 20px; }
        .form-grid { grid-template-columns: 1fr; gap: 15px; }
        .form-actions { padding: 20px; flex-direction: column; }
        .btn-primary, .btn-secondary { width: 100%; justify-content: center; }
        .form-input-small { width: 75px; }
    }
    @media (max-width: 480px) {
        .payment-summary { padding: 15px; }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
function formatRp(val) {
    return 'Rp ' + Number(val || 0).toLocaleString('id-ID');
}

function hitungSisa() {
    const total = parseFloat(document.getElementById('harga_total').value) || 0;
    const dp    = parseFloat(document.getElementById('jumlah_dp').value)    || 0;
    const sisa  = total - dp;

    document.getElementById('sum-total').textContent = formatRp(total);
    document.getElementById('sum-dp').textContent    = formatRp(dp);
    document.getElementById('sum-sisa').textContent  = formatRp(sisa < 0 ? 0 : sisa);

    // Auto-set status jika dp >= total
    const selectStatus = document.getElementById('status_pembayaran');
    if (dp >= total && total > 0) {
        selectStatus.value = 'lunas';
    } else if (dp > 0 && dp < total) {
        if (selectStatus.value !== 'lunas') selectStatus.value = 'dp';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi ringkasan saat halaman load
    hitungSisa();

    // Listen perubahan harga_total juga
    document.getElementById('harga_total').addEventListener('input', hitungSisa);
    document.getElementById('jumlah_dp').addEventListener('input', hitungSisa);
});
</script>

@endsection