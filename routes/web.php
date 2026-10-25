<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

// Halaman utama
Route::get('/', [HomeController::class, 'index']);

// Halaman tentang
Route::get('/tentang', [HomeController::class, 'tentang']);

// Halaman kontak
Route::get('/kontak', [HomeController::class, 'kontak']);

// Halaman dashboard (tujuan redirect setelah login, dipakai juga oleh AuthenticatedLayout)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => inertia('Dashboard', [
        'laravelVersion' => app()->version(),
    ]))->name('dashboard');
});

// Halaman profil (dipakai dropdown pengguna di AuthenticatedLayout)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route buku hanya dapat diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
});

// Memuat route autentikasi Laravel Breeze
require __DIR__ . '/auth.php';
