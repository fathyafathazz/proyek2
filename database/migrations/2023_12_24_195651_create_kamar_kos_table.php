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
        Schema::create('kamar_kos', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id_kos');
            $table->string('nomor_kamar');
            $table->string('ukuran_kamar');
            $table->text('keterangan_kamar');
            $table->integer('harga_sewa');
            $table->text('fasilitas_kamar');
            $table->json('fasilitas_custom')->nullable();
            $table->integer('jumlah_kamar_tersedia');
            $table->timestamps();

            $table->foreign('id_kos')->references('id')->on('kos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_kos');
    }
};
