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
        Schema::create('fasilitas_kos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->uuid('id_kos');
            // $table->uuid('id_fasilitas');
            // $table->timestamps();

            // $table->foreign('id_kos')->references('id')->on('kos')->onDelete('cascade');
            // $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');

            // $table->unique(['id_kos', 'id_fasilitas']); // Menambahkan constraint unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_kos');
    }
};
