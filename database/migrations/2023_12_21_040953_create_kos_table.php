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
        Schema::create('kos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_kos');
            $table->string('alamat_kos');
            $table->text('deskripsi_kos');
            $table->uuid('id_kategoris');
            $table->uuid('id_jenis_kos');
            // $table->uuid('id_fasilitas');
            // $table->integer('jumlah_kamar_tersedia');
            // $table->integer('jumlah_kamar_terisi');
            $table->timestamps();

            $table->foreign('id_kategoris')->references('id')->on('kategoris');
            // $table->foreign('id_jenis_kos')->references('id')->on('jenis_kos');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
