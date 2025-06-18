<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi Laravel
    protected $table = 'produk'; 

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'kategori',
        'jumlah',
    ];

    public function postingan()
{
    return $this->hasMany(Postingan::class, 'id_produk');
}

public function pemesanan()
{
    return $this->hasMany(PemesananProduk::class, 'id_produk');
}
}
