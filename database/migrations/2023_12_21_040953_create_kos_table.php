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
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->string('nama_kos');
            $table->string('alamat_kos');
            $table->text('keterangan_kos');
            $table->text('fasilitas');
            $table->string('kategori');
            $table->uuid('id_pemilikkos');
            // $table->uuid('id_kategoris');
            // $table->uuid('id_jenis_kos');
            
          
            $table->timestamps();

            // $table->foreign('id_kategoris')->references('id')->on('kategoris');
            // $table->foreign('id_jenis_kos')->references('id')->on('jenis_kos');
            $table->foreign('id_pemilikkos')->references('id')->on('users');
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
