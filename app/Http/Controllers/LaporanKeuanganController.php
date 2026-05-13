<?php
// app/Http/Controllers/LaporanKeuanganController.php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $periode     = $request->get('periode', 'bulan');
        $bulanFilter = $request->get('bulan_filter'); // null = semua bulan

        [$startDate, $endDate, $labelFormat, $groupFormat] = $this->getPeriodeRange($periode);

        $grafikData = $this->getGrafikData($startDate, $endDate, $periode, $labelFormat, $groupFormat);

        // Kalau ada bulan_filter, override range untuk grafik & riwayat
        if ($bulanFilter) {
            $tahun        = Carbon::now()->year;
            $startRiwayat = Carbon::create($tahun, $bulanFilter, 1)->startOfMonth();
            $endRiwayat   = Carbon::create($tahun, $bulanFilter, 1)->endOfMonth();
            // Grafik per hari untuk bulan yang dipilih
            $grafikData   = $this->getGrafikData($startRiwayat, $endRiwayat, 'bulan', 'd M', 'Y-m-d');
        } else {
            $startRiwayat = $startDate;
            $endRiwayat   = $endDate;
            $grafikData   = $this->getGrafikData($startDate, $endDate, $periode, $labelFormat, $groupFormat);
        }

        $stats = $this->getStats($startRiwayat, $endRiwayat);

        $riwayat = Pesanan::whereBetween('updated_at', [$startRiwayat, $endRiwayat])
            ->whereIn('status_pembayaran', ['dp', 'lunas'])
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('admin.dashboard', compact('stats', 'grafikData', 'riwayat', 'periode', 'bulanFilter'));
    }
    private function getPeriodeRange(string $periode): array
    {
        return match ($periode) {
            'hari'   => [
                Carbon::today()->startOfDay(),
                Carbon::today()->endOfDay(),
                'H:i',
                'Y-m-d H:00',
            ],
            'minggu' => [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
                'D, d M',
                'Y-W-N', // tahun-minggu-hari
            ],
            'tahun'  => [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
                'M Y',
                'Y-m',
            ],
            default  => [ // bulan (default)
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
                'd M',
                'Y-m-d',
            ],
        };
    }

    private function getStats(Carbon $start, Carbon $end): array
    {
        $query = Pesanan::whereBetween('updated_at', [$start, $end]);

        return [
            'total_pendapatan' => (clone $query)->where('status_pembayaran', 'lunas')->sum('harga_total'),
            'total_dp'         => (clone $query)->where('status_pembayaran', 'dp')->sum('jumlah_dp'),
            'total_piutang'    => (clone $query)->whereIn('status_pembayaran', ['dp', 'belum_bayar'])
                                    ->selectRaw('SUM(harga_total - jumlah_dp) as total')
                                    ->value('total') ?? 0,
            'count_lunas'      => (clone $query)->where('status_pembayaran', 'lunas')->count(),
            'count_dp'         => (clone $query)->where('status_pembayaran', 'dp')->count(),
            'count_belum'      => (clone $query)->where('status_pembayaran', 'belum_bayar')->count(),
        ];
    }

    private function getGrafikData(Carbon $start, Carbon $end, string $periode, string $labelFormat, string $groupFormat): array
    {
        $pesanan = Pesanan::whereBetween('updated_at', [$start, $end])
            ->whereIn('status_pembayaran', ['dp', 'lunas'])
            ->get();

        $grouped = [];
        foreach ($pesanan as $p) {
            $key = Carbon::parse($p->updated_at)->format($groupFormat);
            $label = Carbon::parse($p->updated_at)->locale('id')->translatedFormat($labelFormat);
            if (!isset($grouped[$key])) {
                $grouped[$key] = ['label' => $label, 'lunas' => 0, 'dp' => 0];
            }
            if ($p->status_pembayaran === 'lunas') {
                $grouped[$key]['lunas'] += $p->harga_total;
            } else {
                $grouped[$key]['dp'] += $p->jumlah_dp;
            }
        }

        ksort($grouped);
        $data = array_values($grouped);

        return [
            'labels' => array_column($data, 'label'),
            'lunas'  => array_column($data, 'lunas'),
            'dp'     => array_column($data, 'dp'),
        ];
    }

    // Update status pembayaran dari halaman edit pesanan
    public function updatePembayaran(Request $request, $id)
    {
        $request->validate([
            'harga_total'       => 'required|numeric|min:0',
            'jumlah_dp'         => 'nullable|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->only(['harga_total', 'jumlah_dp', 'status_pembayaran']));

        return back()->with('success', 'Data pembayaran berhasil diperbarui.');
    }
}