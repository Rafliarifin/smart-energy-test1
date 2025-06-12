@extends('layouts.app')

{{-- Mengatur judul unik untuk halaman ini, yang akan muncul di header dan tab browser --}}
@section('title', 'Dashboard Energi')

{{-- Ini adalah bagian konten yang akan disuntikkan ke dalam @yield('content') di file layout --}}
@section('content')

{{-- Kode di bawah ini adalah konten spesifik untuk Halaman Dashboard --}}
{{-- Sesuai dengan fitur "Dashboard Informasi Energi" pada makalah Anda [cite: 40] --}}
<section id="dashboard">
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Konsumsi Bulan Ini</h3>
            <div class="stat-value">487 kWh</div>
            <div class="stat-change negative">↑ 12% dari bulan lalu</div>
        </div>
        <div class="stat-card">
            <h3>Biaya Listrik</h3>
            <div class="stat-value">Rp 703.500</div>
            <div class="stat-change positive">↓ 8% dari bulan lalu</div>
        </div>
        <div class="stat-card">
            <h3>Efisiensi Energi</h3>
            <div class="stat-value">78%</div>
            <div class="stat-change positive">↑ 5% dari bulan lalu</div>
        </div>
        <div class="stat-card">
            <h3>CO₂ Tersimpan</h3>
            <div class="stat-value">142 kg</div>
            <div class="stat-change positive">↑ 23% dari bulan lalu</div>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Konsumsi Energi Harian</h3>
            <div class="chart-filters">
                <button class="filter-btn active" data-period="7d">7 Hari</button>
                <button class="filter-btn" data-period="30d">30 Hari</button>
                <button class="filter-btn" data-period="90d">90 Hari</button>
            </div>
        </div>
        <canvas id="energyChart" width="400" height="200"></canvas>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Distribusi Konsumsi per Perangkat</h3>
            </div>
            <canvas id="deviceChart" width="400" height="300"></canvas>
        </div>
        
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Tren Efisiensi Bulanan</h3>
            </div>
            <canvas id="efficiencyChart" width="400" height="300"></canvas>
        </div>

    </div>
</section>

@endsection