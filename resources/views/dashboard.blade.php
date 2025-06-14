@extends('layouts.app')
@section('title', 'Dashboard Energi')
@section('content')
<section id="dashboard">

    {{-- Kartu Statistik Dinamis --}}
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Konsumsi Tahunan Terbaru</h3>
            <div class="stat-value">{{ number_format($stats['latest_kwh'], 2) }} kWh</div>
            <p class="stat-change positive">📈 Data Terkini</p>
        </div>
        <div class="stat-card">
            <h3>Estimasi Biaya Bulanan</h3>
            <div class="stat-value">Rp {{ number_format($stats['monthly_cost'], 0, ',', '.') }}</div>
            <p class="stat-change positive">💰 Berdasarkan Konsumsi</p>
        </div>
        <div class="stat-card">
            <h3>Perubahan Efisiensi</h3>
            <div class="stat-value">{{ number_format($stats['efficiency_change'], 2) }}%</div>
            @if($stats['efficiency_change'] > 0)
                <div class="stat-change positive">↓ Penurunan Konsumsi (Baik)</div>
            @else
                <div class="stat-change negative">↑ Peningkatan Konsumsi (Buruk)</div>
            @endif
        </div>
        <div class="stat-card">
            <h3>CO₂ Tersimpan (Tahun Ini)</h3>
            <div class="stat-value">{{ number_format($stats['co2_saved'], 2) }} kg</div>
            <p class="stat-change positive">🌳 Dibanding Tahun Lalu</p>
        </div>
    </div>

    {{-- Grid untuk Dua Grafik --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; margin-top: 2rem;">

        {{-- Grafik 1: Konsumsi Listrik --}}
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Tren Konsumsi Listrik Tahunan (kWh per Kapita)</h3>
            </div>
            <canvas id="consumptionChart"></canvas>
        </div>

        {{-- Grafik 2: Rasio Elektrifikasi --}}
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Tren Rasio Elektrifikasi (%)</h3>
            </div>
            <canvas id="ratioChart"></canvas>
        </div>

    </div>
</section>
@endsection

@push('scripts')
{{-- Memindahkan skrip ke @push agar lebih rapi --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Inisialisasi Grafik Konsumsi ---
    if (document.getElementById('consumptionChart')) {
        const ctx = document.getElementById('consumptionChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Ganti jadi bar chart agar menarik
            data: {
                labels: @json($consumptionLabels),
                datasets: [{
                    label: 'Konsumsi (kWh)',
                    data: @json($consumptionValues),
                    backgroundColor: '#16a085',
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    }

    // --- Inisialisasi Grafik Rasio Elektrifikasi ---
    if (document.getElementById('ratioChart')) {
        const ctx = document.getElementById('ratioChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($ratioLabels),
                datasets: [{
                    label: 'Rasio (%)',
                    data: @json($ratioValues),
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderColor: '#3498db',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: false, max: 100 } } }
        });
    }
});
</script>
@endpush