<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SmartEnergy') - Platform Energi Cerdas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    {{-- SELURUH GAYA (CSS) DITEMPATKAN DI SINI UNTUK KONSISTENSI TAMPILAN --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            z-index: 1000;
            transform: translateX(0);
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-280px);
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #16a085;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-header .logo::before {
            content: "⚡";
            font-size: 1.8rem;
        }

        .user-info {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-info p {
            font-size: 0.875rem;
            opacity: 0.7;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.5rem 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(22, 160, 133, 0.2);
            border-left-color: #16a085;
        }

        .nav-icon {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Header */
        .header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
        }

        .header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #16a085, #27ae60);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .logout-btn {
            padding: 0.5rem 1rem;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /*
           Kita tidak lagi memerlukan .page-section dan .page-section.active
           karena setiap fitur akan menjadi halaman sendiri.
        */

        /* Dashboard Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #16a085;
        }

        .stat-card h3 {
            font-size: 0.875rem;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stat-change {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stat-change.positive {
            color: #27ae60;
        }

        .stat-change.negative {
            color: #e74c3c;
        }

        /* Chart Container */
        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .chart-filters {
            display: flex;
            gap: 0.5rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background: #16a085;
            color: white;
            border-color: #16a085;
        }

        /* Calculator Form */
        .calculator-form {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #16a085;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #16a085, #27ae60);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(22, 160, 133, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .appliance-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid #16a085;
        }

        .appliance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .appliance-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .remove-appliance {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            cursor: pointer;
        }

        .calculation-result {
            background: linear-gradient(135deg, #16a085, #27ae60);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            margin-top: 2rem;
        }

        .result-value {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .result-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .recommendations {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .recommendation-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem;
            border-left: 4px solid #f39c12;
            background: #fdf6e3;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .recommendation-icon {
            font-size: 1.5rem;
            margin-top: 0.25rem;
        }

        /* Forum Styles */
        .forum-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .create-post-btn {
            background: linear-gradient(135deg, #16a085, #27ae60);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .forum-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e9ecef;
        }

        .tab-btn {
            padding: 1rem 1.5rem;
            background: none;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            color: #7f8c8d;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            color: #16a085;
            border-bottom-color: #16a085;
        }

        .forum-post {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .forum-post:hover {
            transform: translateY(-2px);
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .post-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #16a085, #27ae60);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .author-info h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .author-info span {
            font-size: 0.875rem;
            color: #7f8c8d;
        }

        .post-meta {
            font-size: 0.875rem;
            color: #7f8c8d;
        }

        .post-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
        }

        .post-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .post-tags {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .tag {
            background: #e8f5e8;
            color: #16a085;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .post-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .action-btn:hover {
            color: #16a085;
        }

        /* FAQ Styles */
        .faq-search {
            margin-bottom: 2rem;
        }

        .search-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            background: white;
        }

        .faq-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .category-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .category-card:hover,
        .category-card.active {
            border-color: #16a085;
            transform: translateY(-2px);
        }

        .category-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .category-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .category-count {
            font-size: 0.875rem;
            color: #7f8c8d;
        }

        .faq-item {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #2c3e50;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: #f8f9fa;
        }

        .faq-toggle {
            font-size: 1.2rem;
            color: #16a085;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item.active .faq-answer {
            padding: 0 1.5rem 1.5rem;
            max-height: 200px;
        }

        .faq-answer p {
            color: #555;
            line-height: 1.6;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 1rem;
            }

            .content {
                padding: 1rem;
            }

            .forum-tabs {
                flex-wrap: wrap;
            }

            .faq-categories {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #16a085;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Success/Error Messages */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }

        .alert-info {
            background: #cce7ff;
            color: #004085;
            border-left-color: #007bff;
        }
        /* ... (CSS Anda yang sudah ada) ... */

/* Gaya Khusus untuk Admin Dashboard */
.admin-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.admin-grid-small {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

/* Untuk layar lebih besar, buat layout lebih kompleks */
@media (min-width: 1024px) {
    .admin-grid {
        grid-template-columns: 2fr 1.5fr; /* Kolom kiri lebih besar */
    }
    .admin-grid-small {
        grid-template-columns: 1fr;
    }
}

.admin-panel {
    display: flex;
    flex-direction: column;
}

.panel-description {
    font-size: 0.9rem;
    color: #7f8c8d;
    margin-top: -1rem;
    margin-bottom: 1.5rem;
    flex-grow: 1; /* Membuat deskripsi mengisi ruang */
}

.panel-actions {
    margin-top: auto; /* Mendorong tombol ke bawah */
    text-align: right;
}

.admin-table-wrapper {
    overflow-x: auto; /* Agar tabel bisa di-scroll di mobile */
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
}

.admin-table th, .admin-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #e9ecef;
}

.admin-table th {
    font-weight: 600;
    font-size: 0.875rem;
    color: #2c3e50;
}

.admin-table tbody tr:hover {
    background-color: #f8f9fa;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    border: none;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    color: white;
}

.btn-edit {
    background-color: #f39c12;
}

.btn-delete {
    background-color: #e74c3c;
}
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">SmartEnergy</div>
            <div class="user-info">
    {{-- Mengambil nama lengkap dari user yang terautentikasi --}}
    {{-- Sesuai dengan field 'nama_lengkap' pada class diagram Anda [cite: 82] --}}
    <h3>{{ Auth::user()->nama_lengkap }}</h3> 
    <p>Pengguna Premium</p>
</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ url('/calculator') }}" class="nav-link {{ Request::is('calculator*') ? 'active' : '' }}">
                    <span class="nav-icon">🧮</span>
                    <span>Kalkulator Energi</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ url('/forum') }}" class="nav-link {{ Request::is('forum*') ? 'active' : '' }}">
                    <span class="nav-icon">💬</span>
                    <span>Forum & FAQ</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">⚙️</span>
                    <span>Pengaturan</span>
                </a>
            </div>
        </nav>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <h1 id="pageTitle">@yield('title')</h1>
            </div>
            <div class="header-right">
                <div class="user-avatar">JD</div>
                {{-- Form untuk logout yang aman --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="logout-btn" 
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </a>
                </form>
            </div>
        </header>

        <div class="content">
            {{-- Blade 'yield' directive untuk menyuntikkan konten halaman --}}
            @yield('content')
        </div>
    </main>

    {{-- SEMUA FUNGSI (JAVASCRIPT) DITEMPATKAN DI SINI AGAR TERSEDIA GLOBAL --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- FUNGSI DASAR: MENU TOGGLE UNTUK MOBILE ---
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        }

        // --- FUNGSI Halaman Dashboard: Inisialisasi Grafik ---
        if (document.getElementById('energyChart')) {
            let energyChartInstance;

            function createEnergyChart(data, labels) {
                const ctx = document.getElementById('energyChart').getContext('2d');
                if (energyChartInstance) {
                    energyChartInstance.destroy();
                }
                energyChartInstance = new Chart(ctx, {
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
                    options: { responsive: true, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
                });
            }

            const data7d = { labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'], data: [15, 18, 16, 20, 22, 25, 23] };
            const data30d = { labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'], data: [120, 135, 115, 140] };
            const data90d = { labels: ['Bulan 1', 'Bulan 2', 'Bulan 3'], data: [450, 487, 465] };

            createEnergyChart(data7d.data, data7d.labels);

            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    const period = this.dataset.period;
                    if (period === '7d') createEnergyChart(data7d.data, data7d.labels);
                    else if (period === '30d') createEnergyChart(data30d.data, data30d.labels);
                    else if (period === '90d') createEnergyChart(data90d.data, data90d.labels);
                });
            });
            
            const deviceCtx = document.getElementById('deviceChart').getContext('2d');
            new Chart(deviceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['AC', 'Kulkas', 'Pencahayaan', 'TV', 'Lainnya'],
                    datasets: [{ label: 'Distribusi Konsumsi', data: [45, 20, 15, 10, 10], backgroundColor: ['#16a085', '#27ae60', '#2ecc71', '#f1c40f', '#e67e22'], hoverOffset: 4 }]
                },
                options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
            });

            const efficiencyCtx = document.getElementById('efficiencyChart').getContext('2d');
            new Chart(efficiencyCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{ label: 'Efisiensi (%)', data: [65, 68, 70, 75, 72, 78], backgroundColor: '#2c3e50', borderWidth: 1 }]
                },
                options: { responsive: true, scales: { y: { beginAtZero: true, max: 100 } }, plugins: { legend: { display: false } } }
            });
        }

        // --- FUNGSI Halaman Kalkulator: Logika Perhitungan ---
        const applianceSelect = document.getElementById('applianceSelect');
        const appliancesList = document.getElementById('appliancesList');
        const calculationResult = document.getElementById('calculationResult');
        const recommendationsDiv = document.getElementById('recommendations');
        let applianceCounter = 0;

        window.addAppliance = function() {
            if (!applianceSelect) return;
            const selectedOption = applianceSelect.options[applianceSelect.selectedIndex];
            if (!selectedOption.value) return;

            applianceCounter++;
            const applianceId = `appliance-${applianceCounter}`;
            const name = selectedOption.text;
            const power = selectedOption.dataset.power;

            const applianceHTML = `
                <div class="appliance-item" id="${applianceId}" data-power="${power}">
                    <div class="appliance-header">
                        <span class="appliance-name">${name}</span>
                        <button class="remove-appliance" onclick="removeAppliance('${applianceId}')">Hapus</button>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Jumlah</label><input type="number" class="form-control quantity" value="1" min="1"></div>
                        <div class="form-group"><label>Jam Pemakaian / Hari</label><input type="number" class="form-control hours" value="1" min="0" max="24" step="0.5"></div>
                    </div>
                </div>`;
            appliancesList.insertAdjacentHTML('beforeend', applianceHTML);
        };

        window.removeAppliance = function(applianceId) {
            const element = document.getElementById(applianceId);
            if (element) element.remove();
        };
        
        window.calculateEnergy = function() {
            if (!appliancesList) return;
            const appliances = document.querySelectorAll('.appliance-item');
            if (appliances.length === 0) {
                calculationResult.innerHTML = '<div class="alert alert-info">Silakan tambahkan perangkat terlebih dahulu.</div>';
                recommendationsDiv.innerHTML = '';
                return;
            }

            let totalDailyKWh = 0;
            const TARIF_PER_KWH = 1444.70;

            appliances.forEach(app => {
                const power = parseFloat(app.dataset.power);
                const quantity = parseInt(app.querySelector('.quantity').value);
                const hours = parseFloat(app.querySelector('.hours').value);
                totalDailyKWh += (power * quantity * hours) / 1000;
            });

            const totalMonthlyKWh = totalDailyKWh * 30;
            const estimatedMonthlyCost = totalMonthlyKWh * TARIF_PER_KWH;

            calculationResult.innerHTML = `
                <div class="calculation-result">
                    <div class="result-label">Estimasi Konsumsi Bulanan</div>
                    <div class="result-value">${totalMonthlyKWh.toFixed(2)} kWh</div>
                    <div class="result-label" style="font-size: 1rem; margin-top: 1rem;">Estimasi Biaya Bulanan</div>
                    <div class="result-value" style="font-size: 2rem;">Rp ${new Intl.NumberFormat('id-ID').format(estimatedMonthlyCost.toFixed(0))}</div>
                </div>`;

            let recommendationsHTML = '<h3 style="margin-bottom: 1.5rem; color: #2c3e50;">Rekomendasi Penghematan</h3>';
            if (totalMonthlyKWh > 300) {
                recommendationsHTML += `<div class="recommendation-item"><div class="recommendation-icon">💡</div><div><strong>Ganti ke Lampu LED:</strong> Mengganti lampu pijar ke LED dapat menghemat energi hingga 80% untuk pencahayaan.</div></div>`;
            }
            if (document.querySelector('.appliance-item[data-power="1000"]')) {
                 recommendationsHTML += `<div class="recommendation-item"><div class="recommendation-icon">❄️</div><div><strong>Atur Suhu AC Optimal:</strong> Atur suhu AC pada 24-26°C. Setiap kenaikan 1°C dapat menghemat listrik hingga 10%.</div></div>`;
            }
            recommendationsHTML += `<div class="recommendation-item"><div class="recommendation-icon">🔌</div><div><strong>Cabut Perangkat Tidak Terpakai:</strong> Cabut charger dan perangkat elektronik dari stop kontak saat tidak digunakan untuk menghindari 'phantom load'.</div></div>`;
            
            recommendationsDiv.innerHTML = recommendationsHTML;
        };

        // --- FUNGSI Halaman Forum & FAQ: Interaksi ---
        const faqItems = document.querySelectorAll('.faq-item');
        const faqSearch = document.getElementById('faqSearch');
        const categoryCards = document.querySelectorAll('.faq-categories .category-card');

        if (faqItems.length > 0) {
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');
                    faqItems.forEach(i => i.classList.remove('active'));
                    if (!isActive) item.classList.add('active');
                });
            });
        }

        if (categoryCards.length > 0) {
            categoryCards.forEach(card => {
                card.addEventListener('click', function() {
                    categoryCards.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    const category = this.dataset.category;
                    faqItems.forEach(item => {
                        item.style.display = (category === 'all' || item.dataset.category === category) ? 'block' : 'none';
                    });
                });
            });
        }

        if (faqSearch) {
            faqSearch.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                faqItems.forEach(item => {
                    const textContent = item.textContent.toLowerCase();
                    item.style.display = textContent.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }
    });
    </script>
</body>
</html>