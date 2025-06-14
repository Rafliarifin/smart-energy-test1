<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\DashboardDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/calculator', function () {
        return view('calculator');
    })->name('calculator');

    // Forum Routes untuk User
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');
    Route::get('/forum/{post}/edit', [ForumController::class, 'edit'])->name('forum.edit');
    Route::put('/forum/{post}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{post}', [ForumController::class, 'destroy'])->name('forum.destroy');
    Route::post('/forum/{post}/reply', [ForumController::class, 'storeReply'])->name('replies.store');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Grup Route Khusus Admin ---
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Kelola Pengguna
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Moderasi Forum
    Route::get('/forum', [AdminForumController::class, 'index'])->name('forum.index');
    Route::delete('/forum/{post}', [AdminForumController::class, 'destroy'])->name('forum.destroy');

    // Kelola FAQ
    Route::resource('faq', AdminFaqController::class);

    // Kelola Data Referensi
    Route::resource('data', \App\Http\Controllers\Admin\DashboardDataController::class)
     ->parameter('data', 'dashboardData');
});

// Memuat route autentikasi bawaan Laravel
require __DIR__.'/auth.php';