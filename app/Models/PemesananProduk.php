<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananProduk extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi
    protected $table = 'pemesanan_produk';

    // Tentukan kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'id_produk', 'jumlah', 'total_harga', 'status'
    ];

    // Relasi dengan produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

}
