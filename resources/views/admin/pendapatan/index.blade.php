@extends('layout.master')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg:        #f0f2f7;
    --surface:   #ffffff;
    --border:    #e4e8f0;
    --indigo:    #4f46e5;
    --indigo-l:  #eef2ff;
    --indigo-d:  #3730a3;
    --green:     #059669;
    --green-l:   #d1fae5;
    --amber:     #d97706;
    --amber-l:   #fef3c7;
    --blue:      #2563eb;
    --blue-l:    #dbeafe;
    --violet:    #7c3aed;
    --violet-l:  #ede9fe;
    --red:       #dc2626;
    --red-l:     #fee2e2;
    --text-dark: #111827;
    --text-mid:  #374151;
    --text-soft: #6b7280;
    --radius:    14px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,.08);
}

body { background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; }

/* ── Page wrapper ── */
.lk-page {
    max-width: 1180px;
    margin: 36px auto;
    padding: 0 20px 60px;
}

/* ── Page header ── */
.lk-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 14px;
}
.lk-topbar-left { display: flex; align-items: center; gap: 14px; }
.lk-icon-wrap {
    width: 48px; height: 48px; border-radius: 12px;
    background: var(--indigo); display: flex; align-items: center;
    justify-content: center; font-size: 1.3rem; color: #fff;
    box-shadow: 0 4px 12px rgba(79,70,229,.35);
}
.lk-topbar h1 { font-size: 1.55rem; font-weight: 800; color: var(--text-dark); line-height: 1.2; }
.lk-topbar p  { font-size: .875rem; color: var(--text-soft); margin-top: 2px; }

/* Periode tabs */
.periode-tabs {
    display: flex;
    gap: 6px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 5px;
    box-shadow: var(--shadow-sm);
}
.btn-periode {
    padding: 8px 18px;
    border-radius: 7px;
    border: none;
    font-size: .875rem;
    font-weight: 600;
    color: var(--text-soft);
    text-decoration: none;
    transition: all .18s ease;
    white-space: nowrap;
}
.btn-periode:hover { color: var(--indigo); background: var(--indigo-l); }
.btn-periode.active {
    background: var(--indigo);
    color: #fff;
    box-shadow: 0 2px 8px rgba(79,70,229,.3);
}

/* ── Alert ── */
.lk-alert {
    background: var(--green-l); color: var(--green);
    border: 1px solid #a7f3d0; border-radius: 10px;
    padding: 13px 18px; margin-bottom: 22px;
    display: flex; align-items: center; gap: 10px;
    font-weight: 500; font-size: .9rem;
}

/* ── KPI Cards ── */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media (max-width: 900px)  { .kpi-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  { .kpi-grid { grid-template-columns: 1fr; } }

.kpi-grid-2col {
    grid-template-columns: repeat(2, 1fr);
    margin-top: -8px;
}

.kpi-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px 18px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
    transition: box-shadow .2s;
}
.kpi-card:hover { box-shadow: var(--shadow-md); }
.kpi-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: var(--radius) var(--radius) 0 0;
}
.kpi-amber::before  { background: var(--amber); }
.kpi-blue::before   { background: var(--blue); }
.kpi-green::before  { background: var(--green); }
.kpi-violet::before { background: var(--violet); }
.kpi-teal::before   { background: #0891b2; }
.kpi-emerald::before{ background: #10b981; }

.kpi-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.kpi-icon {
    width: 38px; height: 38px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
}
.kpi-amber   .kpi-icon { background: var(--amber-l);  color: var(--amber); }
.kpi-blue    .kpi-icon { background: var(--blue-l);   color: var(--blue); }
.kpi-green   .kpi-icon { background: var(--green-l);  color: var(--green); }
.kpi-violet  .kpi-icon { background: var(--violet-l); color: var(--violet); }
.kpi-teal    .kpi-icon { background: #cffafe;         color: #0891b2; }
.kpi-emerald .kpi-icon { background: #d1fae5;         color: #10b981; }

.kpi-badge {
    font-size: .7rem;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 20px;
    letter-spacing: .03em;
}
.kpi-amber   .kpi-badge { background: var(--amber-l);  color: var(--amber); }
.kpi-blue    .kpi-badge { background: var(--blue-l);   color: var(--blue); }
.kpi-green   .kpi-badge { background: var(--green-l);  color: var(--green); }
.kpi-violet  .kpi-badge { background: var(--violet-l); color: var(--violet); }
.kpi-teal    .kpi-badge { background: #cffafe;         color: #0891b2; }
.kpi-emerald .kpi-badge { background: #d1fae5;         color: #10b981; }

.kpi-val {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text-dark);
    line-height: 1;
    word-break: break-word;
}
.kpi-val.kpi-val-rp {
    font-size: .95rem;
    font-weight: 700;
    line-height: 1.3;
    color: var(--text-dark);
}
.kpi-label { font-size: .8rem; color: var(--text-soft); font-weight: 500; }

/* ── Section card ── */
.section-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 26px 28px;
    margin-bottom: 20px;
    box-shadow: var(--shadow-sm);
}
.section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
}
.section-title i { color: var(--indigo); font-size: 1rem; }

/* ── Chart ── */
.chart-wrap {
    position: relative;
    height: 300px;
}
.chart-empty {
    height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: var(--text-soft);
}
.chart-empty i { font-size: 2.5rem; opacity: .35; }
.chart-empty p { font-size: .9rem; }

/* ── Table ── */
.tbl-wrap { overflow-x: auto; }
table.lk-tbl { width: 100%; border-collapse: collapse; font-size: .875rem; }
.lk-tbl thead tr { background: #f8fafc; }
.lk-tbl th {
    padding: 11px 16px;
    text-align: left;
    font-size: .78rem;
    font-weight: 700;
    color: var(--text-soft);
    text-transform: uppercase;
    letter-spacing: .06em;
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
}
.lk-tbl td {
    padding: 13px 16px;
    border-bottom: 1px solid #f1f5f9;
    color: var(--text-mid);
    vertical-align: middle;
}
.lk-tbl tbody tr:last-child td { border-bottom: none; }
.lk-tbl tbody tr:hover td { background: #fafbff; }

.kode-chip {
    font-family: 'Courier New', monospace;
    font-size: .8rem;
    background: var(--indigo-l);
    color: var(--indigo);
    padding: 3px 9px;
    border-radius: 6px;
    font-weight: 600;
}
.td-green  { color: var(--green);  font-weight: 700; }
.td-red    { color: var(--red);    font-weight: 700; }
.td-soft   { color: var(--text-soft); }

.badge-status {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 11px; border-radius: 20px;
    font-size: .75rem; font-weight: 700; letter-spacing: .02em;
}
.badge-lunas  { background: var(--green-l);  color: var(--green); }
.badge-dp     { background: var(--blue-l);   color: var(--blue); }
.badge-belum  { background: var(--amber-l);  color: var(--amber); }

/* ── Bulan filter ── */
.bulan-filter-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 18px;
}
.btn-bulan {
    padding: 5px 13px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text-soft);
    font-size: .78rem;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s ease;
    white-space: nowrap;
}
.btn-bulan:hover  { background: var(--indigo-l); border-color: var(--indigo); color: var(--indigo); }
.btn-bulan.active { background: var(--indigo); border-color: var(--indigo); color: #fff; }

/* ── Pagination custom ── */
.pagination-wrap { margin-top: 20px; }
.pag-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    justify-content: flex-end;
}
.pag-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 34px;
    height: 34px;
    padding: 0 10px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text-mid);
    font-size: .82rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background .15s, border-color .15s, color .15s;
}
.pag-btn:hover        { background: var(--indigo-l); border-color: var(--indigo); color: var(--indigo); }
.pag-btn.pag-active   { background: var(--indigo); border-color: var(--indigo); color: #fff; cursor: default; }
.pag-btn.pag-disabled { opacity: .38; cursor: not-allowed; }
.pagination-info {
    font-size: .78rem;
    color: var(--text-soft);
    margin-top: 8px;
    text-align: right;
}

/* ── Menu grid ── */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 24px;
}
@media (max-width: 640px) { .menu-grid { grid-template-columns: 1fr; } }

.menu-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    padding: 36px 24px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 14px;
    text-decoration: none;
    transition: border-color .2s, box-shadow .2s;
    box-shadow: var(--shadow-sm);
}
.menu-card:hover { border-color: var(--indigo); box-shadow: 0 6px 20px rgba(79,70,229,.12); }
.menu-card i { font-size: 2.5rem; color: var(--indigo); }
.menu-card span { font-size: 1rem; font-weight: 700; color: var(--text-dark); }
.menu-card:nth-child(1):hover i { color: var(--red); }
.menu-card:nth-child(2):hover i { color: var(--green); }
.menu-card:nth-child(3):hover i { color: var(--violet); }

/* ── Responsive ── */
@media (max-width: 768px) {
    .lk-page { margin: 20px auto; padding: 0 14px 40px; }
    .lk-topbar { flex-direction: column; align-items: flex-start; }
    .section-card { padding: 20px 16px; }
}
</style>

<div class="lk-page">

    {{-- ── Top bar ── --}}
    <div class="lk-topbar">
        <div class="lk-topbar-left">
            <div class="lk-icon-wrap"><i class="fas fa-wallet"></i></div>
            <div>
                <h1>Laporan Keuangan</h1>
                <p>Pantau omzet, DP masuk & status pembayaran</p>
            </div>
        </div>
        <nav class="periode-tabs">
            @foreach(['hari' => 'Hari Ini', 'minggu' => 'Minggu Ini', 'bulan' => 'Bulan Ini', 'tahun' => 'Tahun Ini'] as $val => $label)
                <a href="{{ route('laporan.keuangan', ['periode' => $val]) }}"
                   class="btn-periode {{ $periode === $val ? 'active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </div>

    {{-- ── Alert ── --}}
    @if(session('success'))
        <div class="lk-alert"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif


    {{-- ── KPI Cards — Baris 2: Keuangan ── --}}
    <div class="kpi-grid kpi-grid-2col">

        <div class="kpi-card kpi-teal">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <span class="kpi-badge">DP</span>
            </div>
            <div class="kpi-val kpi-val-rp">Rp {{ number_format($stats['total_dp'], 0, ',', '.') }}</div>
            <div class="kpi-label">Total DP Masuk</div>
        </div>

        <div class="kpi-card kpi-emerald">
            <div class="kpi-head">
                <div class="kpi-icon"><i class="fas fa-coins"></i></div>
                <span class="kpi-badge">Lunas</span>
            </div>
            <div class="kpi-val kpi-val-rp">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</div>
            <div class="kpi-label">Total Lunas</div>
        </div>

    </div>

    {{-- ── Grafik ── --}}
    <div class="section-card">
        <div class="section-title">
            <i class="fas fa-chart-bar"></i>
            Grafik Pendapatan
            <span style="margin-left:auto; font-size:.8rem; font-weight:500; color:var(--text-soft);">
                @if($bulanFilter)
                    Per Hari &mdash; {{ \Carbon\Carbon::create(null, $bulanFilter)->locale('id')->translatedFormat('F Y') }}
                @else
                    {{ ['hari'=>'Per Jam','minggu'=>'Per Hari','bulan'=>'Per Hari','tahun'=>'Per Bulan'][$periode] ?? '' }}
                @endif
            </span>
        </div>

        @if(count($grafikData['labels']) > 0)
            <div class="chart-wrap">
                <canvas id="grafikPendapatan"></canvas>
            </div>
        @else
            <div class="chart-empty">
                <i class="fas fa-chart-bar"></i>
                <p>Tidak ada data untuk periode ini.</p>
            </div>
        @endif
    </div>

    {{-- ── Riwayat ── --}}
    <div class="section-card">
        <div class="section-title">
            <i class="fas fa-list-alt"></i>
            Riwayat Pembayaran
        </div>

        {{-- ── Filter Bulan ── --}}
        <div class="bulan-filter-wrap">
            @php
                $bulanList = [
                    1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr',
                    5=>'Mei', 6=>'Jun', 7=>'Jul', 8=>'Agu',
                    9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Des'
                ];
            @endphp

            <a href="{{ route('laporan.keuangan', ['periode' => $periode]) }}"
               class="btn-bulan {{ !$bulanFilter ? 'active' : '' }}">
                Semua
            </a>

            @foreach($bulanList as $num => $nama)
                <a href="{{ route('laporan.keuangan', ['periode' => $periode, 'bulan_filter' => $num]) }}"
                   class="btn-bulan {{ $bulanFilter == $num ? 'active' : '' }}">
                    {{ $nama }}
                </a>
            @endforeach
        </div>

        <div class="tbl-wrap">
            <table class="lk-tbl">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Nama Pesanan</th>
                        <th>Harga Total</th>
                        <th>Jumlah DP</th>
                        <th>Sisa</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $p)
                    <tr>
                        <td><span class="kode-chip">{{ $p->kode_pesanan }}</span></td>
                        <td style="font-weight:600; color:var(--text-dark);">{{ $p->nama_pesanan }}</td>
                        <td>Rp {{ number_format($p->harga_total, 0, ',', '.') }}</td>
                        <td class="td-green">Rp {{ number_format($p->jumlah_dp, 0, ',', '.') }}</td>
                        <td class="{{ $p->sisa_bayar > 0 ? 'td-red' : 'td-soft' }}">
                            Rp {{ number_format($p->sisa_bayar, 0, ',', '.') }}
                        </td>
                        <td>
                            @php
                                $sp         = $p->status_pembayaran;
                                $badgeClass = $sp === 'lunas' ? 'badge-lunas' : ($sp === 'dp' ? 'badge-dp' : 'badge-belum');
                                $icon       = $sp === 'lunas' ? 'fa-check-circle' : ($sp === 'dp' ? 'fa-clock' : 'fa-times-circle');
                                $labelSP    = $sp === 'lunas' ? 'Lunas' : ($sp === 'dp' ? 'DP' : 'Belum Bayar');
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                <i class="fas {{ $icon }}"></i> {{ $labelSP }}
                            </span>
                        </td>
                        <td class="td-soft">{{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:40px; color:var(--text-soft);">
                            <i class="fas fa-inbox" style="font-size:2rem; opacity:.3; display:block; margin-bottom:8px;"></i>
                            Tidak ada data untuk periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayat->hasPages())
            <div class="pagination-wrap">
                <div class="pag-bar">

                    {{-- Tombol Previous --}}
                    @if($riwayat->onFirstPage())
                        <span class="pag-btn pag-disabled">&laquo; Prev</span>
                    @else
                        <a class="pag-btn" href="{{ $riwayat->previousPageUrl() }}&periode={{ $periode }}&bulan_filter={{ $bulanFilter }}">&laquo; Prev</a>
                    @endif

                    {{-- Nomor halaman --}}
                    @foreach($riwayat->getUrlRange(1, $riwayat->lastPage()) as $page => $url)
                        @if($page == $riwayat->currentPage())
                            <span class="pag-btn pag-active">{{ $page }}</span>
                        @else
                            <a class="pag-btn" href="{{ $url }}&periode={{ $periode }}&bulan_filter={{ $bulanFilter }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Tombol Next --}}
                    @if($riwayat->hasMorePages())
                        <a class="pag-btn" href="{{ $riwayat->nextPageUrl() }}&periode={{ $periode }}&bulan_filter={{ $bulanFilter }}">Next &raquo;</a>
                    @else
                        <span class="pag-btn pag-disabled">Next &raquo;</span>
                    @endif

                </div>
                <div class="pagination-info">
                    Menampilkan {{ $riwayat->firstItem() }}–{{ $riwayat->lastItem() }} dari {{ $riwayat->total() }} data
                </div>
            </div>
        @endif
    </div>

    {{-- ── Menu navigasi ── --}}
    <div class="menu-grid">
        <a href="{{ route('pesanan.index') }}" class="menu-card">
            <i class="fas fa-clipboard-list"></i>
            <span>Kelola Pesanan</span>
        </a>
        <a href="{{ route('bahan.index') }}" class="menu-card">
            <i class="fas fa-box"></i>
            <span>Kelola Bahan</span>
        </a>
        <a href="{{ route('katalog.index') }}" class="menu-card">
            <i class="fas fa-book"></i>
            <span>Kelola Katalog</span>
        </a>
    </div>

</div>

<script>
/* ── Chart.js ───────────────────────────────────────────────────────── */
@if(count($grafikData['labels']) > 0)
(function() {
    const labels = @json($grafikData['labels']);
    const lunas  = @json($grafikData['lunas']);
    const dp     = @json($grafikData['dp']);

    const ctx = document.getElementById('grafikPendapatan').getContext('2d');

    const gLunas = ctx.createLinearGradient(0, 0, 0, 300);
    gLunas.addColorStop(0, 'rgba(5,150,105,.85)');
    gLunas.addColorStop(1, 'rgba(5,150,105,.35)');

    const gDp = ctx.createLinearGradient(0, 0, 0, 300);
    gDp.addColorStop(0, 'rgba(37,99,235,.75)');
    gDp.addColorStop(1, 'rgba(37,99,235,.25)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Lunas',
                    data: lunas,
                    backgroundColor: gLunas,
                    borderColor: 'rgba(5,150,105,1)',
                    borderWidth: 1.5,
                    borderRadius: { topLeft: 6, topRight: 6 },
                    borderSkipped: false,
                    barPercentage: 0.65,
                    categoryPercentage: 0.75,
                },
                {
                    label: 'DP',
                    data: dp,
                    backgroundColor: gDp,
                    borderColor: 'rgba(37,99,235,1)',
                    borderWidth: 1.5,
                    borderRadius: { topLeft: 6, topRight: 6 },
                    borderSkipped: false,
                    barPercentage: 0.65,
                    categoryPercentage: 0.75,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        padding: 18,
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '600' }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#94a3b8',
                    bodyColor: '#f1f5f9',
                    padding: 14,
                    cornerRadius: 10,
                    displayColors: true,
                    boxWidth: 10,
                    boxHeight: 10,
                    callbacks: {
                        label: ctx => ' ' + ctx.dataset.label + ': Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: {
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 11, weight: '500' },
                        color: '#9ca3af'
                    }
                },
                y: {
                    grid: { color: 'rgba(0,0,0,.05)', drawBorder: false },
                    border: { display: false, dash: [4,4] },
                    ticks: {
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                        color: '#9ca3af',
                        callback: v => 'Rp ' + (v >= 1000000 ? (v/1000000).toLocaleString('id-ID') + ' jt' : v.toLocaleString('id-ID'))
                    }
                }
            }
        }
    });
})();
@endif

/* ── Realtime order stats ───────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    async function fetchOrderStats() {
        try {
            const res  = await fetch('/api/dashboard/stats');
            if (!res.ok) throw new Error();
            const data = await res.json();
            document.getElementById('count-menunggu').textContent = data.menunggu || 0;
            document.getElementById('count-proses').textContent   = data.proses   || 0;
            document.getElementById('count-selesai').textContent  = data.selesai  || 0;
            document.getElementById('count-total').textContent    = data.total    || 0;
        } catch {
            document.getElementById('count-menunggu').textContent = {{ \App\Models\Pesanan::where('status','menunggu')->count() }};
            document.getElementById('count-proses').textContent   = {{ \App\Models\Pesanan::where('status','proses')->count() }};
            document.getElementById('count-selesai').textContent  = {{ \App\Models\Pesanan::where('status','selesai')->count() }};
            document.getElementById('count-total').textContent    = {{ \App\Models\Pesanan::count() }};
        }
    }
    fetchOrderStats();
    setInterval(fetchOrderStats, 30000);
});
</script>

@endsection