@extends('layout.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --bg: #f0f2f7; --surface: #ffffff; --border: #e4e8f0;
    --indigo: #4f46e5; --indigo-l: #eef2ff;
    --green: #059669; --green-l: #d1fae5;
    --amber: #d97706; --amber-l: #fef3c7;
    --blue: #2563eb; --blue-l: #dbeafe;
    --violet: #7c3aed; --violet-l: #ede9fe;
    --red: #dc2626; --red-l: #fee2e2;
    --teal: #0891b2; --teal-l: #cffafe;
    --emerald: #10b981; --emerald-l: #d1fae5;
    --text-dark: #111827; --text-mid: #374151; --text-soft: #6b7280;
    --radius: 14px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,.06);
    --shadow-md: 0 4px 16px rgba(0,0,0,.08);
}
body { background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; }

.db-page { max-width: 1180px; margin: 36px auto; padding: 0 20px 60px; }

/* Header */
.db-header { margin-bottom: 28px; }
.db-header h1 { font-size: 1.6rem; font-weight: 800; color: var(--text-dark); }
.db-header p  { font-size: .9rem; color: var(--text-soft); margin-top: 4px; }
.db-header span { color: var(--indigo); font-weight: 700; }

/* KPI Grid */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-bottom: 16px;
}
.kpi-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px; margin-bottom: 24px;
}
@media (max-width: 900px) { .kpi-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 480px) { .kpi-grid, .kpi-grid-2 { grid-template-columns: 1fr; } }

.kpi-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 20px 18px;
    display: flex; flex-direction: column; gap: 10px;
    box-shadow: var(--shadow-sm); position: relative;
    overflow: hidden; transition: box-shadow .2s;
}
.kpi-card:hover { box-shadow: var(--shadow-md); }
.kpi-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px; border-radius: var(--radius) var(--radius) 0 0;
}
.c-amber::before   { background: var(--amber); }
.c-blue::before    { background: var(--blue); }
.c-green::before   { background: var(--green); }
.c-violet::before  { background: var(--violet); }
.c-teal::before    { background: var(--teal); }
.c-emerald::before { background: var(--emerald); }

.kpi-head { display: flex; align-items: center; justify-content: space-between; }
.kpi-icon { width: 38px; height: 38px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
.c-amber   .kpi-icon { background: var(--amber-l);   color: var(--amber); }
.c-blue    .kpi-icon { background: var(--blue-l);    color: var(--blue); }
.c-green   .kpi-icon { background: var(--green-l);   color: var(--green); }
.c-violet  .kpi-icon { background: var(--violet-l);  color: var(--violet); }
.c-teal    .kpi-icon { background: var(--teal-l);    color: var(--teal); }
.c-emerald .kpi-icon { background: var(--emerald-l); color: var(--emerald); }

.kpi-badge { font-size: .7rem; font-weight: 700; padding: 3px 9px; border-radius: 20px; }
.c-amber   .kpi-badge { background: var(--amber-l);   color: var(--amber); }
.c-blue    .kpi-badge { background: var(--blue-l);    color: var(--blue); }
.c-green   .kpi-badge { background: var(--green-l);   color: var(--green); }
.c-violet  .kpi-badge { background: var(--violet-l);  color: var(--violet); }
.c-teal    .kpi-badge { background: var(--teal-l);    color: var(--teal); }
.c-emerald .kpi-badge { background: var(--emerald-l); color: var(--emerald); }

.kpi-val       { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); line-height: 1; }
.kpi-val-sm    { font-size: .95rem; font-weight: 700; color: var(--text-dark); line-height: 1.3; }
.kpi-label     { font-size: .8rem; color: var(--text-soft); font-weight: 500; }

/* Section card */
.section-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 24px 26px;
    margin-bottom: 20px; box-shadow: var(--shadow-sm);
}
.section-title {
    display: flex; align-items: center; gap: 10px;
    font-size: 1rem; font-weight: 700; color: var(--text-dark);
    margin-bottom: 20px; padding-bottom: 14px;
    border-bottom: 1px solid var(--border);
}
.section-title i { color: var(--indigo); }
.section-title a {
    margin-left: auto; font-size: .78rem; font-weight: 600;
    color: var(--indigo); text-decoration: none;
}
.section-title a:hover { text-decoration: underline; }

/* Tabel pesanan terbaru */
table.db-tbl { width: 100%; border-collapse: collapse; font-size: .875rem; }
.db-tbl th {
    padding: 10px 14px; text-align: left; font-size: .75rem;
    font-weight: 700; color: var(--text-soft); text-transform: uppercase;
    letter-spacing: .06em; border-bottom: 2px solid var(--border);
    background: #f8fafc; white-space: nowrap;
}
.db-tbl td {
    padding: 12px 14px; border-bottom: 1px solid #f1f5f9;
    color: var(--text-mid); vertical-align: middle;
}
.db-tbl tbody tr:last-child td { border-bottom: none; }
.db-tbl tbody tr:hover td { background: #fafbff; }

.kode-chip {
    font-family: 'Courier New', monospace; font-size: .78rem;
    background: var(--indigo-l); color: var(--indigo);
    padding: 3px 8px; border-radius: 6px; font-weight: 600;
}
.badge-status {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 10px; border-radius: 20px;
    font-size: .72rem; font-weight: 700;
}
.badge-menunggu { background: var(--amber-l);  color: var(--amber); }
.badge-proses   { background: var(--blue-l);   color: var(--blue); }
.badge-selesai  { background: var(--green-l);  color: var(--green); }
.td-soft { color: var(--text-soft); font-size: .82rem; }

/* Shortcut grid */
.shortcut-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}
@media (max-width: 768px) { .shortcut-grid { grid-template-columns: repeat(2,1fr); } }

.shortcut-card {
    background: var(--surface); border: 1.5px solid var(--border);
    border-radius: var(--radius); padding: 24px 16px;
    display: flex; flex-direction: column; align-items: center;
    gap: 10px; text-decoration: none;
    transition: border-color .2s, box-shadow .2s; box-shadow: var(--shadow-sm);
}
.shortcut-card:hover { border-color: var(--indigo); box-shadow: 0 6px 20px rgba(79,70,229,.1); }
.shortcut-card i { font-size: 1.8rem; color: var(--indigo); }
.shortcut-card span { font-size: .875rem; font-weight: 700; color: var(--text-dark); text-align: center; }

@media (max-width: 768px) {
    .db-page { margin: 20px auto; padding: 0 14px 40px; }
}
</style>

<div class="db-page">

    {{-- Header --}}
    <div class="db-header">
        <h1>Selamat datang, <span>{{ Auth::user()->nama ?? 'Admin' }}</span> 👋</h1>
        <p>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }} &mdash; Ini ringkasan aktivitas hari ini.</p>
    </div>

    {{-- KPI Pesanan --}}
    <div class="kpi-grid">
        <div class="kpi-card c-amber">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-clock"></i></div>
                <span class="kpi-badge">Pending</span>
            </div>
            <div class="kpi-val">{{ $stats['menunggu'] }}</div>
            <div class="kpi-label">Menunggu Konfirmasi</div>
        </div>
        <div class="kpi-card c-blue">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-cogs"></i></div>
                <span class="kpi-badge">Proses</span>
            </div>
            <div class="kpi-val">{{ $stats['proses'] }}</div>
            <div class="kpi-label">Sedang Diproses</div>
        </div>
        <div class="kpi-card c-green">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
                <span class="kpi-badge">Selesai</span>
            </div>
            <div class="kpi-val">{{ $stats['selesai'] }}</div>
            <div class="kpi-label">Pesanan Selesai</div>
        </div>
        <div class="kpi-card c-violet">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-layer-group"></i></div>
                <span class="kpi-badge">Total</span>
            </div>
            <div class="kpi-val">{{ $stats['total'] }}</div>
            <div class="kpi-label">Semua Pesanan</div>
        </div>
    </div>

    {{-- KPI Keuangan Bulan Ini --}}
    <div class="kpi-grid-2">
        <div class="kpi-card c-teal">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <span class="kpi-badge">Bulan Ini</span>
            </div>
            <div class="kpi-val-sm">Rp {{ number_format($stats['dp_bulan'], 0, ',', '.') }}</div>
            <div class="kpi-label">DP Masuk Bulan Ini</div>
        </div>
        <div class="kpi-card c-emerald">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-coins"></i></div>
                <span class="kpi-badge">Bulan Ini</span>
            </div>
            <div class="kpi-val-sm">Rp {{ number_format($stats['lunas_bulan'], 0, ',', '.') }}</div>
            <div class="kpi-label">Pendapatan Lunas Bulan Ini</div>
        </div>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="section-card">
        <div class="section-title">
            <i class="fas fa-clipboard-list"></i>
            Pesanan Terbaru
            <a href="{{ route('pesanan.index') }}">Lihat Semua &rarr;</a>
        </div>
        <div style="overflow-x:auto;">
            <table class="db-tbl">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Pesanan</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesananTerbaru as $p)
                    <tr>
                        <td><span class="kode-chip">{{ $p->kode_pesanan }}</span></td>
                        <td style="font-weight:600; color:var(--text-dark);">{{ $p->nama_pesanan }}</td>
                        <td>
                            @php
                                $sc = ['menunggu'=>'badge-menunggu','proses'=>'badge-proses','selesai'=>'badge-selesai'][$p->status] ?? 'badge-menunggu';
                                $si = ['menunggu'=>'fa-clock','proses'=>'fa-cogs','selesai'=>'fa-check-circle'][$p->status] ?? 'fa-clock';
                            @endphp
                            <span class="badge-status {{ $sc }}">
                                <i class="fas {{ $si }}"></i> {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            @php
                                $pc = ['lunas'=>'badge-selesai','dp'=>'badge-proses','belum_bayar'=>'badge-menunggu'][$p->status_pembayaran] ?? 'badge-menunggu';
                                $pl = ['lunas'=>'Lunas','dp'=>'DP','belum_bayar'=>'Belum Bayar'][$p->status_pembayaran] ?? '-';
                            @endphp
                            <span class="badge-status {{ $pc }}">{{ $pl }}</span>
                        </td>
                        <td class="td-soft">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:30px; color:var(--text-soft);">
                            Belum ada pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Shortcut Menu --}}
    <div class="section-card">
        <div class="section-title">
            <i class="fas fa-th"></i>
            Menu Cepat
        </div>
        <div class="shortcut-grid">
            <a href="{{ route('pesanan.index') }}" class="shortcut-card">
                <i class="fas fa-clipboard-list"></i>
                <span>Kelola Pesanan</span>
            </a>
            <a href="{{ route('bahan.index') }}" class="shortcut-card">
                <i class="fas fa-box"></i>
                <span>Kelola Bahan</span>
            </a>
            <a href="{{ route('katalog.index') }}" class="shortcut-card">
                <i class="fas fa-cogs"></i>
                <span>Kelola Katalog</span>
            </a>
            <a href="{{ route('laporan.keuangan') }}" class="shortcut-card">
                <i class="fas fa-wallet"></i>
                <span>Laporan Keuangan</span>
            </a>
        </div>
    </div>

</div>
@endsection