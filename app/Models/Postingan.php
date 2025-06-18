<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;
    protected $table = 'postingan';
    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
    'judul',
    'gambar',
    'id_produk', // Pastikan ada di sini
];
   public function produk()
{
    return $this->belongsTo(Produk::class, 'id_produk');
}
}
