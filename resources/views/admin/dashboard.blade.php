@extends('layouts.app')

{{-- Mengatur judul unik untuk Halaman Admin --}}
@section('title', 'Admin Dashboard')

@section('content')

{{-- Sama seperti dashboard user, kita gunakan stat-card untuk ringkasan --}}
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Pengguna</h3>
        <div class="stat-value">142</div>
        <p class="stat-change positive">👥 Pengguna Terdaftar</p>
    </div>
    <div class="stat-card">
        <h3>Total Postingan Forum</h3>
        <div class="stat-value">78</div>
        <p class="stat-change positive">📝 Topik & Balasan</p>
    </div>
    <div class="stat-card">
        <h3>Jumlah FAQ</h3>
        <div class="stat-value">15</div>
        <p class="stat-change positive">❓ Pertanyaan Terjawab</p>
    </div>
    <div class="stat-card">
        <h3>Data Referensi</h3>
        <div class="stat-value">5</div>
        <p class="stat-change positive">📊 Statistik & Tarif</p>
    </div>
</div>

{{-- Grid Utama untuk Panel Manajemen Admin --}}
<div class="admin-grid">

    {{-- 1. Panel Kelola Pengguna --}}
    <div class="stat-card admin-panel">
        <h3 class="chart-title">Kelola Pengguna</h3>
        <p class="panel-description">Lihat, edit, atau hapus data pengguna yang terdaftar di platform.</p>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh data statis, nantinya ini akan dari database --}}
                    <tr>
                        <td>Ahmad Budi</td>
                        <td>ahmad.budi@email.com</td>
                        <td>10 Juni 2025</td>
                    </tr>
                    <tr>
                        <td>Sari Rahayu</td>
                        <td>sari.rahayu@email.com</td>
                        <td>08 Juni 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-actions">
            <a href="#" class="btn btn-primary">Lihat Semua Pengguna</a>
        </div>
    </div>

    {{-- 2. Panel Moderasi Forum --}}
    <div class="stat-card admin-panel">
        <h3 class="chart-title">Moderasi Forum</h3>
        <p class="panel-description">Kelola postingan forum. Anda dapat menyunting atau menghapus konten yang tidak sesuai.</p>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul Postingan</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                     {{-- Contoh data statis --}}
                    <tr>
                        <td>Tips Menghemat Listrik AC...</td>
                        <td>Ahmad Budi</td>
                        <td>
                            <button class="btn-sm btn-edit">Edit</button>
                            <button class="btn-sm btn-delete">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Pengalaman Menggunakan Panel Surya...</td>
                        <td>Sari Rahayu</td>
                        <td>
                            <button class="btn-sm btn-edit">Edit</button>
                            <button class="btn-sm btn-delete">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-actions">
            <a href="#" class="btn btn-primary">Kelola Semua Postingan</a>
        </div>
    </div>

    {{-- 3. Panel Kelola FAQ & Data Dashboard --}}
    <div class="admin-grid-small">
        <div class="stat-card admin-panel">
            <h3 class="chart-title">Kelola FAQ</h3>
            <p class="panel-description">Tambah, edit, atau hapus pertanyaan dan jawaban di halaman FAQ.</p>
            <div class="panel-actions">
                <a href="#" class="btn btn-primary">Kelola FAQ</a>
            </div>
        </div>
        <div class="stat-card admin-panel">
            <h3 class="chart-title">Update Data Dashboard</h3>
            <p class="panel-description">Perbarui data referensi seperti statistik konsumsi atau tarif energi.</p>
            <div class="panel-actions">
                <a href="#" class="btn btn-primary">Update Data</a>
            </div>
        </div>
    </div>

</div>

@endsection