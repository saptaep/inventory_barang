<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()
            ->view('dashboard')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function produk()
    {
        return view('produk.index'); // Buat view untuk produk
    }

    // public function saham()
    // {
    //     return view('dashboard.saham'); // Buat view untuk saham
    // }

    public function postingan()
    {
        return view('postingan.index'); // Buat view untuk transaksi
    }
}