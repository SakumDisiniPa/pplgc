<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKeuanganController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ForumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');

Route::prefix('forum')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/{discussion}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/{discussion}/comments', [ForumController::class, 'storeComment'])->name('forum.comments.store');
    Route::delete('/forum-images/{image}', [ForumController::class, 'destroyImage'])
    ->name('forum.images.destroy');
});

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Manajemen Konten
    Route::resource('berita', AdminBeritaController::class);
    Route::resource('galeri', AdminGaleriController::class)->names([
        'create' => 'admin.galeri.create',
        'store' => 'admin.galeri.store'
    ]);
    Route::resource('forum', AdminForumController::class);
    Route::resource('informasi', AdminInformasiController::class);
    
    // Manajemen User
    Route::resource('users', AdminUserController::class);
    Route::post('/users/{user}/change-role', [AdminUserController::class, 'changeRole'])
         ->name('users.change-role');
    
    // Manajemen Siswa & Guru
    Route::resource('siswa', AdminSiswaController::class);
    Route::resource('guru', AdminGuruController::class);
    
    // Manajemen Keuangan
    Route::get('/keuangan', [AdminKeuanganController::class, 'index'])->name('admin.keuangan');
    Route::post('/keuangan/pemasukan', [AdminKeuanganController::class, 'tambahPemasukan'])
         ->name('admin.keuangan.pemasukan');
    Route::post('/keuangan/pengeluaran', [AdminKeuanganController::class, 'tambahPengeluaran'])
         ->name('admin.keuangan.pengeluaran');
    Route::get('/keuangan/laporan', [AdminKeuanganController::class, 'laporan'])
         ->name('admin.keuangan.laporan');

    Route::resource('berita', AdminBeritaController::class)->names([
            'create' => 'admin.berita.create'
        ]);
});

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
Route::resource('galeri', GaleriController::class);

require __DIR__.'/auth.php';
