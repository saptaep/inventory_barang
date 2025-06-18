<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostinganTable extends Migration
{
    public function up()
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->string('judul'); // Kolom judul
            $table->string('gambar'); // Kolom gambar
            $table->unsignedBigInteger('id_produk')->nullable(); // Kolom foreign key yang nullable
            $table->foreign('id_produk') // Mendefinisikan relasi foreign key
                  ->references('id') // Mengacu pada kolom id di tabel produk
                  ->on('produk') // Nama tabel yang dirujuk
                  ->onDelete('cascade'); // Menghapus postingan terkait jika produk dihapus
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::table('postingan', function (Blueprint $table) {
            // Menghapus foreign key sebelum menghapus tabel
            $table->dropForeign(['id_produk']);
        });

        // Menghapus tabel postingan
        Schema::dropIfExists('postingan');
    }
}
