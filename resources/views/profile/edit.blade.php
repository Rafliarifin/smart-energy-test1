@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="profile-container">
    <div class="profile-grid">

        {{-- KARTU UNTUK UPDATE INFORMASI PROFIL --}}
        <div class="stat-card">
            <h3 class="chart-title" style="margin-bottom: 1.5rem;">Informasi Profil</h3>
            <p class="panel-description" style="margin-top: -1rem;">
                Perbarui informasi profil dan alamat email akun Anda.
            </p>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required autofocus>
                    {{-- Menampilkan error validasi jika ada --}}
                    @error('nama_lengkap')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                     @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="panel-actions">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        {{-- KARTU UNTUK UPDATE PASSWORD --}}
        <div class="stat-card">
            <h3 class="chart-title" style="margin-bottom: 1.5rem;">Ubah Password</h3>
            <p class="panel-description" style="margin-top: -1rem;">
                Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
            </p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input id="current_password" name="current_password" type="password" class="form-control" required>
                     @error('current_password', 'updatePassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                     @error('password', 'updatePassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                </div>

                <div class="panel-actions">
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>

        {{-- KARTU UNTUK HAPUS AKUN --}}
        <div class="stat-card" style="border-left-color: #e74c3c;">
             <h3 class="chart-title" style="margin-bottom: 1.5rem;">Hapus Akun</h3>
            <p class="panel-description" style="margin-top: -1rem;">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
            </p>
             <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                 <div class="form-group">
                    <label for="password_delete">Konfirmasi dengan Password Anda</label>
                    <input id="password_delete" name="password" type="password" class="form-control" placeholder="Masukkan password untuk konfirmasi" required>
                     @error('password', 'userDeletion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="panel-actions">
                    <button type="submit" class="btn btn-danger">Hapus Akun Permanen</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection