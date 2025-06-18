<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_saham_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSahamTable extends Migration
{
    public function up()
    {
        Schema::create('saham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('produk');
            $table->integer('quantity');
            $table->dateTime('entry_date');
            $table->dateTime('exit_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('saham');
    }
}
