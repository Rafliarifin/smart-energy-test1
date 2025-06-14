<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardDataController;
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

    Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [App\Http\Controllers\ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}', [App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{post}/reply', [App\Http\Controllers\ForumController::class, 'storeReply'])->name('replies.store');

// ... (rute lain seperti profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // routes/web.php

// --- Grup Route untuk Forum ---
    Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [App\Http\Controllers\ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}', [App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{post}/reply', [App\Http\Controllers\ForumController::class, 'storeReply'])->name('replies.store');
    Route::get('/forum/{post}/edit', [App\Http\Controllers\ForumController::class, 'edit'])->name('forum.edit');
    Route::put('/forum/{post}', [App\Http\Controllers\ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{post}', [App\Http\Controllers\ForumController::class, 'destroy'])->name('forum.destroy');
});


// --- Grup Route Khusus Admin ---
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // INI ADALAH RUTE YANG BENAR UNTUK KELOLA PENGGUNA
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Biarkan rute placeholder lain yang belum kita kerjakan
    Route::get('/forum', [AdminForumController::class, 'index'])->name('forum.index');
    Route::delete('/forum/{post}', [AdminForumController::class, 'destroy'])->name('forum.destroy');

    Route::resource('faq', AdminFaqController::class);

    Route::resource('data', \App\Http\Controllers\Admin\DashboardDataController::class)->names('admin.data');
});


// Route untuk Kelola Pengguna
Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
// Memuat route autentikasi bawaan Laravel
require __DIR__.'/auth.php';