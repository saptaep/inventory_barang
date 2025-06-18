<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_produk_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('kategori'); // Menambahkan kolom kategori
            $table->integer('jumlah'); // Menambahkan kolom jumlah
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
