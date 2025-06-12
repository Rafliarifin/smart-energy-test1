@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="profile-container">
    <div class="profile-grid">

        {{-- KARTU UNTUK UPDATE INFORMASI PROFIL --}}
        <div class="stat-card">
            {{-- Menggunakan Form dari Partial Breeze, tetapi di dalam tema kita --}}
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- KARTU UNTUK UPDATE PASSWORD --}}
        <div class="stat-card">
            @include('profile.partials.update-password-form')
        </div>

        {{-- KARTU UNTUK HAPUS AKUN --}}
        <div class="stat-card" style="border-left-color: #e74c3c;">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
@endsection