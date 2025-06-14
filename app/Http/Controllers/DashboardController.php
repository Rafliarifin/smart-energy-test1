<?php

namespace App\Http\Controllers;

use App\Models\DashboardData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // --- Data untuk Grafik 1: Konsumsi Listrik ---
    $consumptionData = DashboardData::where('metric_name', 'Konsumsi Listrik')
        ->latest('period_date')->take(12)->get()->sortBy('period_date');

    $consumptionLabels = $consumptionData->pluck('period_date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y'));
    $consumptionValues = $consumptionData->pluck('metric_value');

    // --- Data untuk Grafik 2: Rasio Elektrifikasi ---
    $ratioData = DashboardData::where('metric_name', 'Rasio Elektrifikasi')
        ->latest('period_date')->take(12)->get()->sortBy('period_date');

    $ratioLabels = $ratioData->pluck('period_date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y'));
    $ratioValues = $ratioData->pluck('metric_value');

    // --- Data untuk Kartu Statistik (tetap sama) ---
    $latestConsumption = $consumptionData->last();
    $previousConsumption = $consumptionData->slice(-2, 1)->first();
    $stats = [ 'latest_kwh' => 0, 'monthly_cost' => 0, 'efficiency_change' => 0, 'co2_saved' => 0 ];
    if ($latestConsumption) {
        $stats['latest_kwh'] = $latestConsumption->metric_value;
        $stats['monthly_cost'] = ($latestConsumption->metric_value / 12) * 1444.70;
        if ($previousConsumption) {
            $kwhChange = $previousConsumption->metric_value - $latestConsumption->metric_value;
            $stats['efficiency_change'] = ($kwhChange / $previousConsumption->metric_value) * 100;
            if ($kwhChange > 0) { $stats['co2_saved'] = $kwhChange * 0.85; }
        }
    }

    // --- Kirim SEMUA data ke view ---
    return view('dashboard', [
        'consumptionLabels' => $consumptionLabels,
        'consumptionValues' => $consumptionValues,
        'ratioLabels' => $ratioLabels,
        'ratioValues' => $ratioValues,
        'stats' => $stats,
    ]);
}
}