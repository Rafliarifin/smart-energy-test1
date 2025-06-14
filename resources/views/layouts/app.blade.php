<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SmartEnergy') - Platform Energi Cerdas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">SmartEnergy</div>
            <div class="user-info">
                <h3>{{ Auth::user()->nama_lengkap }}</h3> 
                <p>{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>
        <nav class="sidebar-nav">
    {{-- Tampilkan menu ini HANYA JIKA role user adalah 'admin' --}}
    @if (Auth::user()->role === 'admin')
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                <span class="nav-icon">👑</span>
                <span>Admin Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                <span class="nav-icon">👥</span>
                <span>Kelola Pengguna</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.forum.index') }}" class="nav-link {{ Request::is('admin/forum*') ? 'active' : '' }}">
                <span class="nav-icon">🛡️</span>
                <span>Moderasi Forum</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.faq.index') }}" class="nav-link {{ Request::is('admin/faq*') ? 'active' : '' }}">
                <span class="nav-icon">❓</span>
                <span>Kelola FAQ</span>
            </a>
        </div>
         <div class="nav-item">
            <a href="{{ route('admin.data.index') }}" class="nav-link {{ Request::is('admin/data-referensi*') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                <span>Update Data</span>
            </a>
        </div>

    {{-- JIKA BUKAN admin, tampilkan menu untuk user biasa --}}
    @else
        <div class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('calculator') }}" class="nav-link {{ Request::is('calculator*') ? 'active' : '' }}">
                <span class="nav-icon">🧮</span>
                <span>Kalkulator Energi</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('forum.index') }}" class="nav-link {{ Request::is('forum*') ? 'active' : '' }}">
                <span class="nav-icon">💬</span>
                <span>Forum & FAQ</span>
            </a>
        </div>
    @endif
</nav>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <h1 id="pageTitle">@yield('title')</h1>
            </div>
            <div class="header-right">
                {{-- 1. Avatar sekarang adalah sebuah link ke halaman profil --}}
                 <a href="{{ route('profile.edit') }}" title="Lihat Profil">
                    <div class="user-avatar">
                    {{-- Ikon SVG untuk profil --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                 </svg>
                </div>
                    </a>

                {{-- 2. Tombol Logout tetap sama --}}
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
    {{-- Letakkan di bagian bawah file resources/views/layouts/app.blade.php --}}
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- FUNGSI DASAR: MENU TOGGLE UNTUK MOBILE (GLOBAL) ---
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                });
            }

    // --- FUNGSI Halaman Dashboard: Inisialisasi Grafik ---

    // --- FUNGSI Halaman Kalkulator: Logika Perhitungan ---
    if (document.getElementById('applianceSelect')) {
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
                </div><br>`;

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
    }

    // --- FUNGSI Halaman Forum & FAQ ---
    const forumPage = document.querySelector('.forum-tabs');
    if (forumPage) {
        // Logika untuk Tab Forum & FAQ
        const tabButtons = forumPage.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        const createPostButton = document.querySelector('.create-post-btn');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                this.classList.add('active');
                const tabId = this.dataset.tab;
                document.getElementById(tabId + 'Content').classList.add('active');
                if (createPostButton) {
                    createPostButton.style.display = (tabId === 'forum') ? 'inline-block' : 'none';
                }
            });
        });

        // Logika untuk Accordion/Dropdown FAQ
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                // Optional: tutup semua item lain saat satu dibuka
                // faqItems.forEach(i => i.classList.remove('active'));
                if (!isActive) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        });

        // Logika untuk Pencarian FAQ
        const faqSearch = document.getElementById('faqSearch');
        if(faqSearch) {
            faqSearch.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                faqItems.forEach(item => {
                    const textContent = item.textContent.toLowerCase();
                    item.style.display = textContent.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }
    }

});
</script>
@stack('scripts')

</body>
</html>