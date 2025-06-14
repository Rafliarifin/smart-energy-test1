<?php

namespace App\Http\Controllers;

use App\Models\DashboardData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pertama, redirect admin ke dashboard mereka sendiri
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // --- Ambil Data untuk Grafik ---
        $energyData = DashboardData::where('metric_name', 'Konsumsi Listrik')
                            ->latest('period_date')
                            ->take(12) // Ambil 12 data terbaru
                            ->get()
                            ->sortBy('period_date'); // Urutkan dari yang terlama ke terbaru

        // Proses data untuk dikirim ke Chart.js
        $chartLabels = $energyData->pluck('period_date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y'));
        $chartValues = $energyData->pluck('metric_value');

        // --- Perhitungan untuk Kartu Statistik ---
        $latestConsumption = $energyData->last();
        $previousConsumption = $energyData->slice(-2, 1)->first();

        // Siapkan array stats dengan nilai default
        $stats = [
            'latest_kwh' => 0,
            'monthly_cost' => 0,
            'efficiency_change' => 0,
            'co2_saved' => 0,
        ];

        if ($latestConsumption) {
            $stats['latest_kwh'] = $latestConsumption->metric_value;
            // Estimasi biaya bulanan (konsumsi tahunan / 12 bulan * tarif)
            $stats['monthly_cost'] = ($latestConsumption->metric_value / 12) * 1444.70;

            // Lakukan perbandingan hanya jika ada data pembanding
            if ($previousConsumption) {
                $kwhChange = $previousConsumption->metric_value - $latestConsumption->metric_value;
                $stats['efficiency_change'] = ($kwhChange / $previousConsumption->metric_value) * 100;

                if ($kwhChange > 0) {
                    // Faktor emisi rata-rata PLN sekitar 0.85 kg CO2 per kWh
                    $stats['co2_saved'] = $kwhChange * 0.85;
                }
            }
        }

        // --- Kirim semua data yang dibutuhkan ke view ---
        return view('dashboard', [
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'stats' => $stats, // INI YANG PALING PENTING
        ]);
    }
}