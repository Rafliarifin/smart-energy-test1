<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
// Tambahkan Controller yang akan kita butuhkan nanti
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Route Publik ---
Route::get('/', function () {
    return view('welcome');
});

// --- Grup Route User yang Terautentikasi ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/calculator', function () {
        return view('calculator');
    })->name('calculator');

    Route::get('/forum', function () {
        return view('forum');
    })->name('forum');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- Grup Route Khusus Admin ---
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    
    // === PERBAIKAN UTAMA ADA DI SINI ===
    // Mengubah return string menjadi return view.
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Sekarang memuat file view yang benar.
    })->name('dashboard');
    // ===================================

    // === ROUTE BARU UNTUK FITUR ADMIN ===
    // Route ini ditambahkan agar tombol di dashboard admin tidak error 404.
    // Untuk sekarang, mereka hanya menampilkan teks placeholder.

    // Route untuk Kelola Pengguna
    Route::get('/users', function() {
        return "<h1>Halaman Kelola Pengguna (Segera Hadir)</h1>";
    })->name('users.index');

    // Route untuk Moderasi Forum
    Route::get('/forum', function() {
        return "<h1>Halaman Moderasi Forum (Segera Hadir)</h1>";
    })->name('forum.index');

    // Route untuk Kelola FAQ
    Route::get('/faq', function() {
        return "<h1>Halaman Kelola FAQ (Segera Hadir)</h1>";
    })->name('faq.index');

    // Route untuk Update Data Referensi
    Route::get('/data-referensi', function() {
        return "<h1>Halaman Update Data Referensi (Segera Hadir)</h1>";
    })->name('data.index');
});


// Memuat route autentikasi bawaan Laravel
require __DIR__.'/auth.php';