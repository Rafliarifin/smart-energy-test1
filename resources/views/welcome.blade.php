<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartEnergy - Platform Digital Energi Bersih</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #16a085;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo::before {
            content: "⚡";
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #16a085;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #16a085 0%, #27ae60 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(22, 160, 133, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #16a085;
            border: 2px solid #16a085;
        }

        .btn-secondary:hover {
            background: #16a085;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 8rem 0 4rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="none"><path d="M0,0 C150,100 350,0 500,50 C650,100 850,0 1000,50 L1000,0 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: 100% 100px;
            animation: wave 10s linear infinite;
        }

        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .energy-circle {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(45deg, #16a085, #27ae60, #2ecc71);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: pulse 3s ease-in-out infinite;
        }

        .energy-circle::before {
            content: '🌱';
            font-size: 4rem;
            animation: float 2s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }

        /* Features Section */
        .features {
            padding: 5rem 0;
            background: #f8f9fa;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #16a085, #27ae60);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #7f8c8d;
            line-height: 1.6;
        }

        /* Benefits Section */
        .benefits {
            padding: 5rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .benefits-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .benefits-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .benefits-list {
            list-style: none;
            space-y: 1rem;
        }

        .benefits-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .benefits-list li::before {
            content: '✓';
            color: #2ecc71;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #2ecc71;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* CTA Section */
        .cta-section {
            padding: 5rem 0;
            background: #2c3e50;
            color: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: #1a252f;
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #16a085;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #16a085;
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 1rem;
            text-align: center;
            color: #bdc3c7;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .benefits-content {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .energy-circle {
                width: 200px;
                height: 200px;
            }

            .energy-circle::before {
                font-size: 3rem;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
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
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>SmartEnergy</h3>
                    <p>Platform digital terdepan untuk pemantauan konsumsi energi dan edukasi energi bersih di Indonesia.</p>
                </div>
                <div class="footer-section">
                    <h3>Fitur</h3>
                    <ul>
                        <li><a href="#">Dashboard Energi</a></li>
                        <li><a href="#">Kalkulator Energi</a></li>
                        <li><a href="#">Forum Diskusi</a></li>
                        <li><a href="#">FAQ Energi</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Dukungan</h3>
                    <ul>
                        <li><a href="#">Panduan Pengguna</a></li>
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">Kontak Support</a></li>
                        <li><a href="#">Lapor Bug</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Tentang</h3>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Tim Developer</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 SmartEnergy. Dikembangkan oleh Tim Ilmu Komputer Universitas Halu Oleo. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

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

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for navigation links
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