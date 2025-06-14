@extends('layouts.app')

@section('title', 'Forum & FAQ')

@section('content')
<div class="forum-header">
    <h2 style="color: #2c3e50;">Komunitas & Bantuan</h2>
    {{-- Tombol ini hanya akan berfungsi di tab forum --}}
    <a href="{{ route('forum.create') }}" class="create-post-btn">+ Buat Topik Baru</a>
</div>

{{-- NAVIGASI TAB --}}
<div class="forum-tabs">
    <button class="tab-btn active" data-tab="forum">Forum Diskusi</button>
    <button class="tab-btn" data-tab="faq">Pertanyaan Umum (FAQ)</button>
</div>

{{-- KONTEN PANEL --}}
<div>
    {{-- Panel 1: Konten Forum Diskusi (Aktif secara default) --}}
    <div id="forumContent" class="tab-content active">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="forum-posts">
            @forelse ($posts as $post)
                <div class="forum-post">
                    <div class="post-header">
                        <div class="post-author">
                            <div class="author-avatar">{{ strtoupper(substr($post->user->nama_lengkap, 0, 2)) }}</div>
                            <div class="author-info">
                                <h4>{{ $post->user->nama_lengkap }}</h4>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="post-meta">
                            <span>💬 {{ $post->replies()->count() }} balasan</span>
                        </div>
                    </div>
                    <a href="{{ route('forum.show', $post->id) }}" style="text-decoration: none;">
                        <h3 class="post-title">{{ $post->title }}</h3>
                    </a>
                    <p class="post-content">{{ Str::limit($post->content, 150) }}</p>
                </div>
            @empty
                <div class="stat-card" style="text-align: center;">
                    <p>Belum ada topik diskusi. Jadilah yang pertama membuat topik!</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 2rem;">
            {{ $posts->links() }}
        </div>
    </div>

    {{-- Panel 2: Konten FAQ (Tersembunyi secara default) --}}
    <div id="faqContent" class="tab-content">
        {{-- Kita ambil kode FAQ dari file forum.blade.php lama Anda --}}
        <div class="faq-search">
            <input type="text" class="search-input" placeholder="🔍 Cari pertanyaan..." id="faqSearch">
        </div>

        <div class="faq-list" style="margin-top: 2rem;">
            <div class="faq-list" style="margin-top: 2rem;">

    @forelse ($faqs as $faq)
        <div class="faq-item">
            <div class="faq-question">
                <span>{{ $faq->question }}</span> {{-- <-- Data dari database --}}
                <span class="faq-toggle">▼</span>
            </div>
            <div class="faq-answer">
                <p>{{ $faq->answer }}</p> {{-- <-- Data dari database --}}
            </div>
        </div>
    @empty
        {{-- Pesan ini akan muncul jika tidak ada FAQ di database --}}
        <div class="stat-card" style="text-align: center;">
            <p>Belum ada Pertanyaan Umum yang tersedia saat ini.</p>
        </div>
    @endforelse

    </div>
            </div>
        </div>
    </div>
</div>
@endsection