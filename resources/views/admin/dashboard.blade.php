@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

{{-- Bagian ini sudah bagus, kita pertahankan --}}
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Pengguna</h3>
        <div class="stat-value">{{ \App\Models\User::count() }}</div>
        <p class="stat-change positive">👥 Pengguna Terdaftar</p>
    </div>
    <div class="stat-card">
        <h3>Total Topik Forum</h3>
        <div class="stat-value">{{ \App\Models\Post::count() }}</div>
        <p class="stat-change positive">📝 Topik Dibuat</p>
    </div>
    <div class="stat-card">
        <h3>Total Balasan Forum</h3>
        <div class="stat-value">{{ \App\Models\Reply::count() }}</div>
        <p class="stat-change positive">💬 Total Balasan</p>
    </div>
    <div class="stat-card">
        <h3>Jumlah FAQ</h3>
        {{-- Kita akan buat model FAQ nanti, untuk sekarang statis dulu --}}
        <div class="stat-value">5</div>
        <p class="stat-change positive">❓ Pertanyaan Terjawab</p>
    </div>
</div>

{{-- INI ADALAH BAGIAN YANG KITA UBAH --}}
{{-- Grid baru untuk navigasi, bukan untuk menampilkan tabel --}}
<div style="margin-top: 2rem;">
    <h3 class="chart-title" style="margin-bottom: 1.5rem;">Panel Manajemen</h3>
    <div class="admin-grid">

        {{-- 1. Kartu Navigasi Kelola Pengguna --}}
        <div class="stat-card admin-panel">
            <h3 class="chart-title">Kelola Pengguna</h3><br>
            <p class="panel-description">Lihat, cari, dan hapus data pengguna yang terdaftar di platform.</p>
            <div class="panel-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Buka Manajemen Pengguna</a>
            </div>
        </div>

        {{-- 2. Kartu Navigasi Moderasi Forum --}}
        <div class="stat-card admin-panel">
            <h3 class="chart-title">Moderasi Forum</h3><br>
            <p class="panel-description">Kelola semua topik dan balasan forum. Anda dapat menghapus konten yang tidak sesuai.</p>
            <div class="panel-actions">
                <a href="{{ route('admin.forum.index') }}" class="btn btn-primary">Buka Moderasi Forum</a>
            </div>
        </div>

        {{-- 3. Kartu Navigasi Kelola FAQ --}}
        <div class="stat-card admin-panel">
            <h3 class="chart-title">Kelola FAQ</h3><BR></BR>
            <p class="panel-description">Tambah, edit, atau hapus pertanyaan dan jawaban di halaman FAQ.</p>
            <div class="panel-actions">
                <a href="{{ route('admin.faq.index') }}" class="btn btn-primary">Buka Manajemen FAQ</a>
            </div>
        </div>

        {{-- 4. Kartu Navigasi Update Data --}}
         <div class="stat-card admin-panel">
            <h3 class="chart-title">Update Data Referensi</h3><br>
            <p class="panel-description">Perbarui data referensi seperti statistik konsumsi atau tarif energi.</p>
            <div class="panel-actions">
                <a href="{{ route('admin.data.index') }}" class="btn btn-primary">Update Data</a>
            </div>
        </div>
    </div>
</div>

@endsection