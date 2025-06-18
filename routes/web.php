<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SahamController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (harus login untuk mengakses konten)
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('home'); // Pastikan hanya tamu yang bisa melihat halaman ini

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// Route untuk halaman registrasi
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest') // Hanya dapat diakses oleh pengguna yang belum login
    ->name('register');

// Route untuk proses penyimpanan data registrasi
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest') // Hanya dapat diakses oleh pengguna yang belum login
    ->name('register.store');

    
// Route untuk halaman dashboard (dilindungi middleware auth)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// // Route resource untuk Saham
// Route::resource('saham', SahamController::class);

// Route resource untuk Produk
Route::resource('produk', ProdukController::class);

// Route untuk Postingan
Route::prefix('postingan')->middleware('auth')->group(function () {
    Route::get('/', [PostinganController::class, 'index'])->name('postingan.index');
    Route::get('/create', [PostinganController::class, 'create'])->name('postingan.create');
    Route::post('/', [PostinganController::class, 'store'])->name('postingan.store');
    Route::delete('/{id}', [PostinganController::class, 'destroy'])->name('postingan.destroy');
    Route::get('/postingan/{id}/edit', [PostinganController::class, 'edit'])->name('postingan.edit');
    Route::put('/postingan/{id}', [PostinganController::class, 'update'])->name('postingan.update');
});
// Route untuk Pemesanan Produk
Route::prefix('pemesanan')->middleware('auth')->group(function () {
    Route::get('/', [PemesananController::class, 'index'])->name('pemesanan.index'); // Menampilkan daftar pemesanan
    Route::get('/create', [PemesananController::class, 'create'])->name('pemesanan.create'); // Menampilkan form create
    Route::post('/', [PemesananController::class, 'store'])->name('pemesanan.store'); // Menyimpan pemesanan
    Route::get('pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit'); // Menampilkan form edit
    Route::put('/{id}', [PemesananController::class, 'update'])->name('pemesanan.update'); // Memperbarui pemesanan
    Route::delete('/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy'); // Menghapus pemesanan
});

Route::get('/laporan-produk', [LaporanController::class, 'laporanProduk'])->name('laporan.produk');
// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
