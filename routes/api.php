<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk menampilkan tabel produk
// Route::resource('produk', ProdukController::class);
// // Route untuk Produk
// Route::resource('produk', ProdukController::class);

