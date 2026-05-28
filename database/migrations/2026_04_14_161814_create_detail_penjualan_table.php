<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('penjualan_id')
                  ->constrained('penjualan')
                  ->cascadeOnDelete();

            $table->unsignedBigInteger('produk_id');

            $table->integer('jumlah_jual');
            $table->integer('harga_jual');
            $table->integer('subtotal');

            $table->timestamps();

            // Optional index biar cepat
            $table->index('produk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
