<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gambar_kamar', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id_kamar_kos');
            $table->string('gambar'); // Kolom untuk menyimpan nama file gambar
            $table->timestamps();

            // Menambahkan foreign key ke tabel kamar_kos
            $table->foreign('id_kamar_kos')->references('id')->on('kamar_kos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_kamar');
    }
};
