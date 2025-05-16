<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKeuanganController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminInformasiController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminForumController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;

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
    Route::resource('galeri', AdminGaleriController::class)->names([
        'index' => 'admin.galeri.index',
        'create' => 'admin.galeri.create',
        'store' => 'admin.galeri.store',
        'show' => 'admin.galeri.show',
        'edit' => 'admin.galeri.edit',
        'update' => 'admin.galeri.update',
        'destroy' => 'admin.galeri.destroy'
    ]);
    //forum
    Route::resource('forum', AdminForumController::class)->names([
        'index' => 'admin.forum.index',
        'create' => 'admin.forum.create',
        'store' => 'admin.forum.store',
        'show' => 'admin.forum.show',
        'edit' => 'admin.forum.edit', 
        'update' => 'admin.forum.update',
        'destroy' => 'admin.forum.destroy'
    ]);

    Route::resource('informasi', AdminInformasiController::class)->names([
        'index' => 'admin.informasi.index',
        'create' => 'admin.informasi.create',
        'store' => 'admin.informasi.store',
        'show' => 'admin.informasi.show',
        'edit' => 'admin.informasi.edit',
        'update' => 'admin.informasi.update',
        'destroy' => 'admin.informasi.destroy'
    ]);
    
    
    // Manajemen User
    Route::resource('users', AdminInformasiController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy'
    ]);
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
            'index' => 'admin.berita.index',
            'create' => 'admin.berita.create',
            'store' => 'admin.berita.store',
            'show' => 'admin.berita.show',
            'edit' => 'admin.berita.edit',
            'update' => 'admin.berita.update',
            'destroy' => 'admin.berita.destroy'
        ]);
});

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
Route::resource('galeri', GaleriController::class);

Route::post('/galeri/{galeri}/comments', [CommentController::class, 'store'])->name('comments.store');


require __DIR__.'/auth.php';
    