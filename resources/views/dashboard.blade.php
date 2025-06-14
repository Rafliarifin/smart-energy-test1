@extends('layouts.app')
@section('title', 'Dashboard Energi Regional')
@section('content')
<section id="dashboard">

    {{-- Kartu Statistik Baru yang Lebih Relevan --}}
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Rasio Elektrifikasi Terbaru</h3>
            <div class="stat-value">{{ number_format($stats['latest_ratio'], 2) }} %</div>
            <p class="stat-change positive">💡 Rumah Tangga Berlistrik</p>
        </div>
        <div class="stat-card">
            <h3>Pengguna Gas/LPG Terbaru</h3>
            <div class="stat-value">{{ number_format($stats['latest_lpg_usage'], 2) }} %</div>
            <p class="stat-change positive">🍳 Rumah Tangga Memasak</p>
        </div>
        <div class="stat-card">
            <h3>Target SDGs #7</h3>
            <div class="stat-value">Tercapai</div>
            <p class="stat-change positive">⚡️ Energi Bersih & Terjangkau</p>
        </div>
         <div class="stat-card">
            <h3>Sumber Data</h3>
            <div class="stat-value">Valid</div>
            <p class="stat-change positive">🏢 BPS & ESDM</p>
        </div>
    </div>

    {{-- Grid untuk Dua Grafik --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2.5rem; margin-top: 2rem;">

        {{-- Grafik 1: Rasio Elektrifikasi --}}
        <div class="chart-container" style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
            <div class="chart-header">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Tren Rasio Elektrifikasi di Sulawesi Tenggara (%)</h3>
            </div>
            <div style="height: 400px; position: relative;">
                <canvas id="ratioChart"></canvas>
            </div>
            <div class="chart-description" style="margin-top: 1rem; padding: 1rem; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #16a085;">
                <h4 style="margin-bottom: 0.75rem; color: #16a085; font-size: 1.1rem;">📊 Analisis Rasio Elektrifikasi</h4>
                
                <div style="margin-bottom: 0.75rem;">
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>🎯 Definisi:</strong> Rasio elektrifikasi mengukur persentase rumah tangga yang telah mendapatkan akses listrik, baik dari PLN maupun non-PLN (genset, solar panel, mikrohidro, dll). Indikator ini menunjukkan tingkat akses energi listrik secara keseluruhan.
                    </p>
                </div>
                
                <div style="margin-bottom: 0.75rem;">
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>🔌 Sumber Listrik yang Diperhitungkan:</strong>
                    </p>
                    <ul style="font-size: 0.875rem; color: #555; margin: 0.5rem 0 0 1.5rem; padding: 0; line-height: 1.5;">
                        <li style="margin-bottom: 0.25rem;"><strong>PLN:</strong> Jaringan listrik negara (mayoritas)</li>
                        <li style="margin-bottom: 0.25rem;"><strong>Non-PLN:</strong> Genset, solar panel, mikrohidro, biogas</li>
                        <li style="margin-bottom: 0.25rem;"><strong>Komunal:</strong> Sistem listrik swadaya masyarakat</li>
                        <li><strong>Hybrid:</strong> Kombinasi berbagai sumber energi</li>
                    </ul>
                </div>
                
                <div style="margin-bottom: 0.75rem;">
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>📈 Mengapa Penting?</strong> Akses listrik universal mendukung pembangunan berkelanjutan melalui peningkatan produktivitas ekonomi, kualitas pendidikan, layanan kesehatan, dan inklusi digital.
                    </p>
                </div>
                
                <div>
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>🚀 Target SDGs #7:</strong> Mencapai akses universal terhadap layanan energi yang terjangkau, andal, dan modern. Sulawesi Tenggara terus berupaya mencapai 100% elektrifikasi melalui ekspansi jaringan PLN dan pengembangan energi terbarukan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Grafik 2: Pengguna Gas/LPG --}}
        <div class="chart-container" style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
            <div class="chart-header">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Tren Pengguna Gas/LPG untuk Memasak di Sulawesi Tenggara (%)</h3>
            </div>
            <div style="height: 400px; position: relative;">
                <canvas id="lpgChart"></canvas>
            </div>
            <div class="chart-description" style="margin-top: 1rem; padding: 1rem; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #3498db;">
                <h4 style="margin-bottom: 0.75rem; color: #3498db; font-size: 1.1rem;">📊 Analisis Penggunaan Gas/LPG</h4>
                
                <div style="margin-bottom: 0.75rem;">
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>🎯 Mengapa Penting?</strong> Transisi ke LPG merupakan bagian dari agenda energi bersih nasional dengan dampak:
                    </p>
                    <ul style="font-size: 0.875rem; color: #555; margin: 0.5rem 0 0 1.5rem; padding: 0; line-height: 1.5;">
                        <li style="margin-bottom: 0.25rem;"><strong>Kesehatan:</strong> Mengurangi polusi udara dalam ruangan</li>
                        <li style="margin-bottom: 0.25rem;"><strong>Lingkungan:</strong> Menurunkan emisi karbon dan deforestasi</li>
                        <li style="margin-bottom: 0.25rem;"><strong>Efisiensi:</strong> LPG 3-4x lebih efisien dari kayu bakar</li>
                        <li><strong>Gender:</strong> Mengurangi beban kerja perempuan</li>
                    </ul>
                </div>
                
                <div style="margin-bottom: 0.75rem;">
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>📈 Interpretasi:</strong> Program konversi minyak tanah ke LPG sejak 2007 berhasil mengubah pola konsumsi energi. Didukung oleh distribusi merata, subsidi LPG 3kg, dan kampanye edukasi.
                    </p>
                </div>
                
                <div>
                    <p style="font-size: 0.875rem; color: #555; line-height: 1.5; margin: 0;">
                        <strong>🚀 Target & Tantangan:</strong> Target 100% penggunaan bahan bakar bersih. Tantangan: akses di daerah terpencil, edukasi keamanan, dan keterjangkauan harga. Sulawesi Tenggara optimis mencapai target energi bersih sesuai SDGs.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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
                    backgroundColor: 'rgba(22, 160, 133, 0.1)',
                    borderColor: '#16a085',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: { 
                    y: { 
                        min: 98,  
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    } 
                } 
            }
        });
    }

    // --- Inisialisasi Grafik Pengguna LPG ---
    if (document.getElementById('lpgChart')) {
        const ctx = document.getElementById('lpgChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($lpgLabels),
                datasets: [{
                    label: 'Pengguna LPG (%)',
                    data: @json($lpgValues),
                    backgroundColor: '#3498db',
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: { 
                    y: { 
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    } 
                } 
            }
        });
    }
});
</script>
@endpush