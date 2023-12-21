<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fasilitas_kamar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_fasilitas_kamar');
            // $table->unsignedBigInteger('id_kamar_kos');
            // $table->unsignedBigInteger('id_fasilitas');
            // tambahkan kolom lain sesuai kebutuhan

            $table->timestamps();

            // $table->foreign('id_kamar_kos')->references('id')->on('kamar_kos');
            // $table->foreign('id_fasilitas')->references('id')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_kamar');
    }
};
