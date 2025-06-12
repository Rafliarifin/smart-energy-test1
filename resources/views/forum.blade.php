@extends('layouts.app')

{{-- Mengatur judul unik untuk halaman ini --}}
@section('title', 'Forum Diskusi & FAQ')

{{-- Konten spesifik untuk Halaman Forum dan FAQ --}}
@section('content')

{{-- BAGIAN FORUM DISKUSI --}}
{{-- Fitur ini sesuai dengan kebutuhan fungsional "Forum Diskusi" pada Tabel 3.1 makalah Anda --}}
<section id="forum">
    <div class="forum-header">
        <h2 style="color: #2c3e50;">Forum Diskusi Energi Bersih</h2>
        <a href="#" class="create-post-btn">+ Buat Topik Baru</a>
    </div>

    <div class="forum-tabs">
        <button class="tab-btn active" data-tab="recent">Terbaru</button>
        <button class="tab-btn" data-tab="popular">Populer</button>
        <button class="tab-btn" data-tab="tips">Tips Hemat</button>
        <button class="tab-btn" data-tab="technology">Teknologi</button>
    </div>

    <div class="forum-posts">
        {{-- Contoh Postingan 1 --}}
        <div class="forum-post">
            <div class="post-header">
                <div class="post-author">
                    <div class="author-avatar">AB</div>
                    <div class="author-info">
                        <h4>Ahmad Budi</h4>
                        <span>2 jam yang lalu</span>
                    </div>
                </div>
                <div class="post-meta">
                    <span>💬 12 balasan</span>
                </div>
            </div>
            <h3 class="post-title">Tips Menghemat Listrik AC Tanpa Mengurangi Kenyamanan</h3>
            <p class="post-content">Halo semua! Saya ingin berbagi beberapa tips yang sudah saya coba untuk menghemat listrik AC di rumah. Dengan beberapa trik sederhana, konsumsi listrik AC saya turun 30% tanpa mengurangi kenyamanan...</p>
            <div class="post-tags">
                <span class="tag">Tips Hemat</span>
                <span class="tag">AC</span>
                <span class="tag">Penghematan</span>
            </div>
            <div class="post-actions">
                <button class="action-btn">👍 Suka (24)</button>
                <button class="action-btn">💬 Balas</button>
                <button class="action-btn">🔗 Bagikan</button>
            </div>
        </div>

        {{-- Contoh Postingan 2 --}}
        <div class="forum-post">
            <div class="post-header">
                <div class="post-author">
                    <div class="author-avatar">SR</div>
                    <div class="author-info">
                        <h4>Sari Rahayu</h4>
                        <span>5 jam yang lalu</span>
                    </div>
                </div>
                <div class="post-meta">
                    <span>💬 8 balasan</span>
                </div>
            </div>
            <h3 class="post-title">Pengalaman Menggunakan Panel Surya untuk Rumah Tangga</h3>
            <p class="post-content">Sudah 6 bulan saya menggunakan panel surya di rumah. Investasi awal memang cukup besar, tapi sekarang tagihan listrik turun drastis. Mau sharing pengalaman dan perhitungan ROI nya...</p>
            <div class="post-tags">
                <span class="tag">Panel Surya</span>
                <span class="tag">Energi Terbarukan</span>
                <span class="tag">Pengalaman</span>
            </div>
            <div class="post-actions">
                <button class="action-btn">👍 Suka (18)</button>
                <button class="action-btn">💬 Balas</button>
                <button class="action-btn">🔗 Bagikan</button>
            </div>
        </div>
    </div>
</section>

{{-- Pemisah visual antara bagian Forum dan FAQ --}}
<hr style="border: none; border-top: 1px solid #e9ecef; margin: 3rem 0;">

{{-- BAGIAN FREQUENTLY ASKED QUESTIONS (FAQ) --}}
{{-- Fitur ini sesuai dengan kebutuhan fungsional "FAQ" pada Tabel 3.1 makalah Anda --}}
<section id="faq">
    <h2 style="margin-bottom: 2rem; color: #2c3e50;">Pertanyaan yang Sering Diajukan (FAQ)</h2>
    
    <div class="faq-search">
        <input type="text" class="search-input" placeholder="🔍 Cari pertanyaan..." id="faqSearch">
    </div>

    <div class="faq-categories">
        <div class="category-card active" data-category="all">
            <div class="category-icon">📚</div>
            <div class="category-name">Semua Kategori</div>
            <div class="category-count">5 pertanyaan</div>
        </div>
        <div class="category-card" data-category="basic">
            <div class="category-icon">⚡</div>
            <div class="category-name">Dasar Energi</div>
            <div class="category-count">2 pertanyaan</div>
        </div>
        <div class="category-card" data-category="saving">
            <div class="category-icon">💰</div>
            <div class="category-name">Penghematan</div>
            <div class="category-count">2 pertanyaan</div>
        </div>
        <div class="category-card" data-category="renewable">
            <div class="category-icon">🌱</div>
            <div class="category-name">Energi Terbarukan</div>
            <div class="category-count">1 pertanyaan</div>
        </div>
    </div>

    <div class="faq-list">
        <div class="faq-item" data-category="basic">
            <div class="faq-question">
                <span>Apa itu efisiensi energi dan mengapa penting?</span>
                <span class="faq-toggle">▼</span>
            </div>
            <div class="faq-answer">
                <p>Efisiensi energi adalah kemampuan untuk menggunakan lebih sedikit energi untuk menghasilkan output yang sama. Ini penting karena membantu mengurangi biaya listrik, mengurangi emisi karbon, dan melestarikan sumber daya alam untuk generasi mendatang.</p>
            </div>
        </div>

        <div class="faq-item" data-category="saving">
            <div class="faq-question">
                <span>Bagaimana cara menghitung konsumsi listrik perangkat elektronik?</span>
                <span class="faq-toggle">▼</span>
            </div>
            <div class="faq-answer">
                <p>Konsumsi listrik dihitung dengan rumus: Daya (Watt) × Waktu Penggunaan (jam) ÷ 1000 = kWh. Contoh: AC 1000W digunakan 8 jam = 1000 × 8 ÷ 1000 = 8 kWh per hari.</p>
            </div>
        </div>
        
        <div class="faq-item" data-category="saving">
            <div class="faq-question">
                <span>Tips praktis menghemat listrik di rumah?</span>
                <span class="faq-toggle">▼</span>
            </div>
            <div class="faq-answer">
                <p>1. Gunakan lampu LED, 2. Atur suhu AC 24-26°C, 3. Cabut charger saat tidak digunakan, 4. Gunakan perangkat berstandar efisiensi tinggi, 5. Manfaatkan cahaya alami di siang hari, 6. Perawatan rutin perangkat elektronik.</p>
            </div>
        </div>

        <div class="faq-item" data-category="renewable">
            <div class="faq-question">
                <span>Apakah panel surya cocok untuk rumah di Indonesia?</span>
                <span class="faq-toggle">▼</span>
            </div>
            <div class="faq-answer">
                <p>Ya, Indonesia memiliki potensi energi surya yang besar karena berada di daerah tropis dengan sinar matahari sepanjang tahun. Panel surya dapat mengurangi tagihan listrik hingga 70-90% dan memiliki payback period sekitar 6-8 tahun.</p>
            </div>
        </div>

        <div class="faq-item" data-category="basic">
            <div class="faq-question">
                <span>Apa perbedaan antara energi terbarukan dan tak terbarukan?</span>
                <span class="faq-toggle">▼</span>
            </div>
            <div class="faq-answer">
                <p>Energi terbarukan berasal dari sumber alam yang dapat pulih dengan cepat, seperti matahari, angin, dan air. Energi tak terbarukan berasal dari sumber daya yang terbatas dan butuh jutaan tahun untuk terbentuk, seperti batu bara, minyak bumi, dan gas alam.</p>
            </div>
        </div>
    </div>
</section>

@endsection