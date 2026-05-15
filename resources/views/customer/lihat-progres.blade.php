@extends('layout.master')

@section('title', 'Detail Pesanan: ' . ($pesanan->kode_pesanan ?? ''))

@section('content')

    <div class="card mb-4 border-0 shadow-sm bg-white text-center position-relative" style="border-radius: 15px;">
        <div class="card-body py-5">
            <h6 class="text-uppercase text-muted letter-spacing-2 mb-2 fw-bold">Kode Pesanan Anda</h6>
            <h1 class="display-3 fw-bold text-primary mb-4" id="orderCode" style="letter-spacing: 3px;">
                {{ $pesanan->kode_pesanan ?? 'N/A' }}
            </h1>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary rounded-pill px-4 shadow-sm" onclick="copyOrderCode()">
                    <i class="fas fa-copy me-2"></i> Salin Kode
                </button>
                <a href="{{ route('customer.cekKodeForm') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-search me-2"></i> Lacak Lainnya
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card mb-4 border-0 shadow-sm bg-white" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center"
                    style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-info-circle me-2 text-primary"></i>Detail Proyek
                    </h5>
                    @php
                        $badgeColor = match ($pesanan->status) {
                            'Selesai' => 'success',
                            'Proses' => 'primary',
                            'Menunggu' => 'warning',
                            default => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $badgeColor }} text-white px-3 py-2 rounded-pill fs-6 shadow-sm">
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </div>

                <div class="card-body text-dark">
                    <div class="row g-4">
                        <div class="col-md-12 text-center text-md-start">
                            <h6 class="text-muted text-uppercase small fw-bold">Nama Mesin / Proyek</h6>
                            <p class="fs-4 fw-bold mb-0 text-dark">
                                {{ $pesanan->nama_pesanan ?? 'Tanpa Nama' }}
                            </p>
                        </div>

                        <div class="col-12">
                            <hr class="text-muted my-0">
                        </div>

                        <div class="col-md-4 text-center text-md-start">
                            <h6 class="text-muted text-uppercase small fw-bold">Tanggal Mulai</h6>
                            <p class="fs-6 fw-semibold mb-0 text-dark">
                                <i class="far fa-calendar-plus me-2 text-success"></i>
                                {{ $pesanan->tanggal_mulai ? \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d F Y') : '-' }}
                            </p>
                        </div>
                        <div class="col-md-4 text-center text-md-start">
                            <h6 class="text-muted text-uppercase small fw-bold">Estimasi Selesai</h6>
                            <p class="fs-6 fw-semibold mb-0 text-dark">
                                <i class="far fa-calendar-check me-2 text-danger"></i>
                                {{ $pesanan->tanggal_selesai ? \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d F Y') : 'Belum ditentukan' }}
                            </p>
                        </div>
                        <div class="col-md-4 text-center text-md-start">
                            <h6 class="text-muted text-uppercase small fw-bold">Total Biaya</h6>
                            <p class="fs-6 fw-semibold mb-0 text-dark">
                                <i class="fas fa-tag me-2 text-warning"></i>
                                Rp {{ number_format($pesanan->total_biaya ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="col-12">
                            <hr class="text-muted my-0">
                        </div>

                        <div class="col-12">
                            <h6 class="text-muted text-uppercase small fw-bold">Spesifikasi / Deskripsi</h6>
                            <div class="p-3 rounded bg-light border">
                                {{ $pesanan->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-white mb-5" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom py-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-tasks me-2 text-success"></i>Riwayat Pengerjaan</h5>
                </div>
                <div class="card-body">
                    @if ($pesanan->progres && $pesanan->progres->count() > 0)
                        <div class="timeline mt-3 px-2">
                            {{-- PERUBAHAN DI SINI: Gunakan sortBy (Tanpa Desc) agar urutan dari tanggal terlama ke terbaru --}}
                            @foreach ($pesanan->progres->sortBy('tanggal_progres') as $prog)
                                @php
                                    $tahap = strtolower($prog->tahap_status);
                                    $percent = 0;

                                    // Logika penentuan persentase
                                    if (str_contains($tahap, 'perancangan')) {
                                        $percent = 20;
                                    } elseif (str_contains($tahap, 'pengerjaan komponen')) {
                                        $percent = 40;
                                    } elseif (str_contains($tahap, 'perakitan')) {
                                        $percent = 60;
                                    } elseif (str_contains($tahap, 'uji coba')) {
                                        $percent = 80;
                                    } elseif (str_contains($tahap, 'finishing')) {
                                        $percent = 100;
                                    } else {
                                        $percent = 0;
                                    }
                                @endphp

                                <div class="timeline-item pb-5 border-start ps-4 position-relative"
                                    style="border-color: #e9ecef;">
                                    <div class="timeline-dot bg-success shadow border-white position-absolute start-0 top-0 translate-middle rounded-circle"
                                        style="width: 20px; height: 20px; border: 3px solid white;"></div>

                                    <div class="p-3 rounded-3 shadow-sm bg-light border">
                                        <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                                            <div>
                                                <span class="badge bg-success border border-success mb-2 rounded-pill">
                                                    {{ $prog->tahap_status }}
                                                </span>
                                                <h6 class="mb-1 fw-bold text-dark">{{ $prog->catatan }}</h6>
                                            </div>
                                            <small class="text-muted bg-white px-2 py-1 rounded border">
                                                <i class="far fa-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($prog->tanggal_progres)->format('d M Y, H:i') }}
                                            </small>
                                        </div>

                                        <div class="progress my-2 bg-white border"
                                            style="height: 8px; border-radius: 10px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $percent }}%"></div>
                                        </div>

                                        @if ($prog->foto)
                                            <div class="mt-3">
                                                <p class="text-muted small mb-1"><i class="fas fa-camera me-1"></i>
                                                    Dokumentasi:</p>
                                                <a href="{{ asset('storage/progres/' . $prog->foto) }}" target="_blank"
                                                    class="d-inline-block overflow-hidden rounded">
                                                    <img src="{{ asset('storage/progres/' . $prog->foto) }}"
                                                        class="img-fluid rounded border shadow-sm hover-zoom"
                                                        style="max-height: 200px; width: auto; object-fit: cover;"
                                                        alt="Bukti Progress">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex p-4 mb-3 border">
                                <i class="fas fa-clipboard-check fa-3x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-dark fw-bold">Belum ada update progress</h5>
                            <p class="text-muted small mb-0">Admin akan segera memperbarui status pengerjaan mesin Anda.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center mb-5">
                <p class="text-white small mb-2 text-shadow-sm">Butuh info lebih lanjut?</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20mau%20tanya%20pesanan%20{{ $pesanan->kode_pesanan }}"
                    target="_blank" class="btn btn-success rounded-pill px-4 shadow-lg hover-scale">
                    <i class="fab fa-whatsapp me-2"></i> Chat Admin via WhatsApp
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function copyOrderCode() {
                var code = document.getElementById("orderCode").innerText.trim();
                navigator.clipboard.writeText(code);
                alert("Kode berhasil disalin: " + code);
            }
        </script>
    @endpush

    <style>
        /* Styling Custom Sederhana */
        .letter-spacing-2 {
            letter-spacing: 2px;
        }

        .hover-zoom {
            transition: transform 0.3s;
        }

        .hover-zoom:hover {
            transform: scale(1.03);
        }

        .hover-scale {
            transition: transform 0.2s;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .timeline-item:last-child {
            border-left: 0 !important;
            padding-bottom: 0 !important;
        }

        .timeline-dot {
            top: 0px !important;
            left: -1px !important;
        }

        /* Text Shadow untuk tulisan putih di atas background foto (hanya untuk footer contact) */
        .text-shadow-sm {
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }
    </style>
@endsection
