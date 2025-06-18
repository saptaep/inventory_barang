<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\PemesananProduk;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporanProduk()
    {
        // Mengambil data produk beserta total jumlah dipesan
        $laporan = Produk::leftJoin('pemesanan_produk', 'produk.id', '=', 'pemesanan_produk.id_produk')
            ->select(
                'produk.id',
                'produk.nama',
                'produk.jumlah as stok_tersedia',
                DB::raw('COALESCE(SUM(pemesanan_produk.jumlah), 0) as total_dipesan')
            )
            ->groupBy('produk.id', 'produk.nama', 'produk.jumlah')
            ->get();

        return view('laporan.produk', compact('laporan'));
    }
}
