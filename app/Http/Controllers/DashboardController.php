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

    // --- Data untuk Grafik 1: Rasio Elektrifikasi ---
    $ratioData = DashboardData::where('metric_name', 'Rasio Elektrifikasi')
        ->latest('period_date')->take(5)->get()->sortBy('period_date');

    $ratioLabels = $ratioData->pluck('period_date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y'));
    $ratioValues = $ratioData->pluck('metric_value');

    // --- Data untuk Grafik 2: Pengguna Gas/LPG ---
    $lpgData = DashboardData::where('metric_name', 'Pengguna Gas/LPG (Memasak)')
        ->latest('period_date')->take(5)->get()->sortBy('period_date');

    $lpgLabels = $lpgData->pluck('period_date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y'));
    $lpgValues = $lpgData->pluck('metric_value');

    // --- Data untuk Kartu Statistik Baru ---
    $stats = [
        'latest_ratio' => $ratioData->last()->metric_value ?? 0,
        'latest_lpg_usage' => $lpgData->last()->metric_value ?? 0,
    ];

    // --- Kirim semua data yang dibutuhkan ke view ---
    return view('dashboard', [
        'ratioLabels' => $ratioLabels,
        'ratioValues' => $ratioValues,
        'lpgLabels' => $lpgLabels,
        'lpgValues' => $lpgValues,
        'stats' => $stats,
    ]);
    }
}