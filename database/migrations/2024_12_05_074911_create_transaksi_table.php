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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('kategori', 255);
            $table->decimal('nominal', 16, 3);
            $table->string('metode', 255);
            $table->string('tipe', 255);
            $table->date('tanggal_transaksi');
            $table->timestamps();

            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
