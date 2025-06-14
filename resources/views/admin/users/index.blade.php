@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="stat-card">
    <h3 class="chart-title">Daftar Pengguna Terdaftar</h3><br>
    <p class="panel-description">Di bawah ini adalah daftar semua pengguna yang terdaftar di platform SmartEnergy.</p>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem;">{{ session('success') }}</div>
    @endif

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d F Y') }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada pengguna lain yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginasi --}}
    <div style="margin-top: 1.5rem;">
        {{ $users->links() }}
    </div>
</div>
@endsection