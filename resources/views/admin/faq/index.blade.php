@extends('layouts.app')
@section('title', 'Kelola FAQ')
@section('content')
<div class="stat-card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h3 class="chart-title">Daftar Pertanyaan Umum (FAQ)</h3><br>
            <p class="panel-description">Tambah, edit, atau hapus FAQ yang akan ditampilkan kepada pengguna.</p>
        </div>
        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">Tambah FAQ Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1.5rem;">{{ session('success') }}</div>
    @endif

    <div class="admin-table-wrapper" style="margin-top: 1.5rem;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Pertanyaan</th>
                    <th style="width: 40%;">Jawaban</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faqs as $faq)
                    <tr>
                        <td>{{ Str::limit($faq->question, 50) }}</td>
                        <td>{{ Str::limit($faq->answer, 70) }}</td>
                        <td style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn-sm btn-edit" style="text-decoration:none; color:white;">Edit</a>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align: center;">Belum ada FAQ.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top: 1.5rem;">{{ $faqs->links() }}</div>
</div>
@endsection