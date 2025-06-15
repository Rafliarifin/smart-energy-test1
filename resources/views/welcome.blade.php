<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartEnergy - Platform Digital Energi Bersih</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="#" class="logo">SmartEnergy</a>
                <ul class="nav-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#benefits">Manfaat</a></li>
                    <li><a href="#about">Tentang</a></li>
                </ul>
                <div class="cta-buttons">
                    <a href="/login" class="btn btn-secondary">Masuk</a>
                    <a href="/register" class="btn btn-primary">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text fade-in">
                    <h1>Masa Depan Energi Bersih Dimulai dari Rumah Anda</h1>
                    <p>Platform digital terdepan untuk memantau konsumsi energi rumah tangga, menghitung efisiensi energi, dan bergabung dalam komunitas energi bersih Indonesia.</p>
                    <div class="cta-buttons">
                        <a href="/register" class="btn btn-primary">Mulai Sekarang</a>
                        <a href="#features" class="btn btn-secondary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="hero-visual fade-in">
                    <div class="energy-circle"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header fade-in">
                <h2>Fitur Unggulan SmartEnergy</h2>
                <p>Tiga fitur utama yang membantu Anda mengelola energi rumah tangga dengan lebih efisien dan berkelanjutan</p>
            </div>
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">📊</div>
                    <h3>Dashboard Energi</h3>
                    <p>Visualisasi data konsumsi energi dengan grafik interaktif, tren penggunaan, dan analisis efisiensi energi rumah tangga Anda.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">🧮</div>
                    <h3>Kalkulator Energi</h3>
                    <p>Hitung estimasi konsumsi energi perangkat elektronik Anda dan dapatkan rekomendasi penghematan yang personal.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">💬</div>
                    <h3>Forum & FAQ Energi</h3>
                    <p>Bergabung dalam diskusi komunitas, berbagi pengalaman, dan akses panduan lengkap tentang energi bersih.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits" id="benefits">
        <div class="container">
            <div class="benefits-content">
                <div class="benefits-text fade-in">
                    <h2>Mengapa Memilih SmartEnergy?</h2>
                    <ul class="benefits-list">
                        <li>Hemat hingga 30% biaya listrik bulanan</li>
                        <li>Monitoring real-time konsumsi energi</li>
                        <li>Edukasi energi bersih terpercaya</li>
                        <li>Komunitas pengguna aktif</li>
                        <li>Rekomendasi personalisasi</li>
                        <li>Mendukung SDGs Indonesia</li>
                    </ul>
                </div>
                <div class="stats-grid fade-in">
                    <div class="stat-card">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Pengguna Aktif</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">30%</span>
                        <span class="stat-label">Penghematan Energi</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Diskusi Forum</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">99%</span>
                        <span class="stat-label">Kepuasan User</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container fade-in">
            <h2>Siap Bergabung dengan Revolusi Energi Bersih?</h2>
            <p>Daftar sekarang dan mulai perjalanan Anda menuju rumah yang lebih hemat energi dan ramah lingkungan</p>
            <div class="cta-buttons">
                <a href="/register" class="btn btn-primary">Daftar Gratis</a>
                <a href="/login" class="btn btn-secondary">Sudah Punya Akun?</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="about">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>SmartEnergy</h3>
                    <p>Platform digital terdepan untuk pemantauan konsumsi energi dan edukasi energi bersih di Indonesia.</p>
                </div>

            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 SmartEnergy. Dikembangkan oleh Tim Ilmu Komputer Universitas Halu Oleo. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>
