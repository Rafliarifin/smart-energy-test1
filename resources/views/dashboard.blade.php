@extends('layouts.app')

@section('title', 'Dashboard Energi')

@section('content')
<section id="dashboard">
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Konsumsi Tahunan Terbaru</h3>
            {{-- Tampilkan data dinamis dari controller --}}
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
            {{-- Tampilkan data dinamis, ubah warna berdasarkan positif/negatif --}}
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

    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Tren Konsumsi Energi Tahunan (kWh per Kapita)</h3>
        </div>
        <canvas id="energyChart" width="400" height="150"></canvas>
    </div>
    
    {{-- Kita biarkan 2 chart di bawah ini statis sebagai contoh --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <div class="chart-container">
            <h3 class="chart-title">Distribusi Konsumsi (Contoh)</h3>
            <canvas id="deviceChart"></canvas>
        </div>
        <div class="chart-container">
            <h3 class="chart-title">Tren Efisiensi (Contoh)</h3>
            <canvas id="efficiencyChart"></canvas>
        </div>
    </div>
</section>
@endsection

@section('scripts')
{{-- Letakkan semua JavaScript khusus halaman ini di sini --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah elemen canvas ada di halaman ini
    if (document.getElementById('energyChart')) {
        const ctx = document.getElementById('energyChart').getContext('2d');
        
        // Ambil data yang dikirim dari DashboardController
        const labels = @json($chartLabels);
        const data = @json($chartValues);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Konsumsi (kWh)',
                    data: data,
                    backgroundColor: 'rgba(22, 160, 133, 0.1)',
                    borderColor: '#16a085',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: false } }, // Boleh tidak dari nol agar fluktuasi terlihat
                plugins: { legend: { display: false } }
            }
        });
    }

    // Chart statis lainnya bisa tetap di sini
    if (document.getElementById('deviceChart')) {
        const deviceCtx = document.getElementById('deviceChart').getContext('2d');
        new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels: ['AC', 'Kulkas', 'Pencahayaan', 'TV', 'Lainnya'],
                datasets: [{ data: [45, 20, 15, 10, 10], backgroundColor: ['#16a085', '#27ae60', '#2ecc71', '#f1c40f', '#e67e22'] }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    }
});
</script>
@endsection