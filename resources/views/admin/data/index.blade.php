@extends('layouts.app')
@section('title', 'Update Data Referensi')
@section('content')
<div class="stat-card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h3 class="chart-title">Daftar Data Referensi Dashboard</h3><br>
            
            <p class="panel-description">Kelola data yang akan ditampilkan pada grafik di dashboard pengguna.</p>
        </div>
        <a href="{{ route('admin.data.create') }}" class="btn btn-primary">Tambah Data Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1.5rem;">{{ session('success') }}</div>
    @endif

    <div class="admin-table-wrapper" style="margin-top: 1.5rem;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Metrik</th>
                    <th>Nilai</th>
                    <th>Tanggal Periode</th>
                    <th>Sumber</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dashboardData as $data)
                    <tr>
                        <td>{{ $data->metric_name }}</td>
                        <td>{{ $data->metric_value }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->period_date)->format('d F Y') }}</td>
                        <td>{{ $data->source }}</td>
                        <td style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.data.edit', $data->id) }}" class="btn-sm btn-edit" style="text-decoration:none; color:white;">Edit</a>
                            <form action="{{ route('admin.data.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align: center;">Belum ada data referensi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- <div style="margin-top: 1.5rem;">{{ $dashboardData->links() }}</div> -->
</div>
@endsection