@extends('layouts.app')

@section('title', 'Detail Topik')

@section('content')
{{-- Tampilkan Topik Utama --}}
<div class="forum-post" style="border-left: 4px solid #16a085;">
    <div class="post-header">
        <div class="post-author">
            <div class="author-avatar">{{ strtoupper(substr($post->user->nama_lengkap, 0, 2)) }}</div>
            <div class="author-info">
                <h4>{{ $post->user->nama_lengkap }}</h4>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
    <h3 class="post-title">{{ $post->title }}</h3>
    <p class="post-content">{{ $post->content }}</p>
    @can('update-post', $post)
    <div class="post-actions" style="border-top: none; padding-top: 0; margin-top: 1rem;">
        <a href="{{ route('forum.edit', $post->id) }}" class="btn-sm btn-edit" style="text-decoration: none; color: white; display: inline-block;">Edit Postingan</a>
        <form action="{{ route('forum.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-sm btn-delete">Hapus</button>
        </form>
    </div>
    @endcan
</div>

<hr style="border: none; border-top: 1px solid #e9ecef; margin: 2rem 0;">

{{-- Tampilkan Semua Balasan --}}
<h3 style="margin-bottom: 1.5rem; color: #2c3e50;">Balasan ({{ $post->replies->count() }})</h3>
@forelse ($post->replies as $reply)
    <div class="forum-post" style="margin-left: 2rem;">
        <div class="post-header">
            <div class="post-author">
                <div class="author-avatar" style="background: #3498db;">{{ strtoupper(substr($reply->user->nama_lengkap, 0, 2)) }}</div>
                <div class="author-info">
                    <h4>{{ $reply->user->nama_lengkap }}</h4>
                    <span>{{ $reply->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        <p class="post-content">{{ $reply->content }}</p>
    </div>
@empty
    <p>Belum ada balasan untuk topik ini.</p>
@endforelse

{{-- Form untuk Membuat Balasan --}}
<div class="calculator-form" style="margin-top: 2rem;">
    <h4 style="margin-bottom: 1.5rem;">Beri Balasan</h4>
    <form action="{{ route('replies.store', $post->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="content" class="form-control" rows="5" placeholder="Tulis balasan Anda di sini..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Balasan</button>
    </form>
</div>
@endsection