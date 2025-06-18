<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananProdukTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel pemesanan_produk.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_produk', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->unsignedBigInteger('id_produk'); // Kolom foreign key id_produk
            $table->integer('jumlah'); // Kolom untuk jumlah produk yang dipesan
            $table->decimal('total_harga', 10, 2); // Kolom total harga pemesanan
            $table->enum('status', ['pending', 'processed', 'completed', 'canceled'])->default('pending'); // Status pemesanan
            $table->timestamps(); // Kolom created_at dan updated_at

            // Definisikan foreign key untuk relasi ke tabel produk
            $table->foreign('id_produk')
                ->references('id')->on('produk') // Kolom id pada tabel produk
                ->onDelete('cascade'); // Menghapus pemesanan jika produk yang terkait dihapus
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus foreign key sebelum menghapus tabel
        Schema::table('pemesanan_produk', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
        });

        // Menghapus tabel pemesanan_produk
        Schema::dropIfExists('pemesanan_produk');
    }
}
