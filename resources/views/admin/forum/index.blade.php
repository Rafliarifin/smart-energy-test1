@extends('layouts.app')

@section('title', 'Moderasi Forum')

@section('content')
<div class="stat-card">
    <h3 class="chart-title">Daftar Semua Topik Forum</h3><br>
    <p class="panel-description">Anda dapat melihat dan menghapus topik yang tidak sesuai dari daftar di bawah ini.</p>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem;">{{ session('success') }}</div>
    @endif

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Judul Topik</th>
                    <th>Penulis</th>
                    <th>Jumlah Balasan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Pastikan kita melakukan looping pada variabel $posts --}}
                @forelse ($posts as $post)
                    <tr>
                        {{-- Tampilkan data dari $post --}}
                        <td>{{ Str::limit($post->title, 40) }}</td>
                        <td>{{ $post->user->nama_lengkap }}</td>
                        <td>{{ $post->replies->count() }}</td>
                        <td>{{ $post->created_at->format('d M Y, H:i') }}</td>
                        <td style="display: flex; gap: 0.5rem; align-items: center;">

                                {{-- Tombol Baru untuk Melihat & Membalas --}}
                                    <a href="{{ route('forum.show', $post->id) }}" class="btn-sm" style="text-decoration:none; color:white; background-color: #3498db;" >
                                        Lihat & Balas
                                    </a>
                                
                                    <a href="{{ route('forum.edit', $post->id) }}" class="btn-sm btn-edit" style="text-decoration:none; color:white;">
                                        Edit
                                    </a>
                                {{-- Tombol Hapus yang sudah ada --}}
                                <form action="{{ route('admin.forum.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus topik ini? Ini akan menghapus semua balasannya juga.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Hapus</button>
                                </form>
                        </td>
                    </tr>
                @empty
                    {{-- Pesan yang benar jika tidak ada post --}}
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada topik forum yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginasi untuk $posts --}}
    <div style="margin-top: 1.5rem;">
        {{ $posts->links() }}
    </div>
</div>
@endsection