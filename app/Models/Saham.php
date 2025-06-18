<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saham extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'sahams'; 

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'product_id', 
        'quantity', 
        'entry_date', 
        'exit_date', 
    ];
}
