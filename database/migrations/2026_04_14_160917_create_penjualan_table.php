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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();

            $table->string('nama_cart')->nullable();
            $table->string('nota')->nullable();

            $table->enum('jenis_jual', ['toko', 'marketplace'])->default('toko');
            $table->enum('status', ['draft', 'hold', 'complete', 'cancel'])->default('draft');

            $table->integer('total_harga_jual')->default(0);
            $table->integer('total_jumlah_jual')->default(0);

            $table->enum('metode_bayar', ['cash', 'qris', 'transfer'])->nullable();

            $table->integer('dibayar')->nullable();
            $table->integer('kembalian')->nullable();

            $table->timestamp('held_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
