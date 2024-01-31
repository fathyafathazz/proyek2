<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKamarKosFasilitasCustomTable extends Migration
{
    public function up()
    {
        Schema::create('kamar_kos_fasilitas_custom', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->foreignUuid('id_kamar_kos')->constrained('kamar_kos');
            $table->foreignUuid('id_fasilitas_custom')->constrained('fasilitas_custom');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('kamar_kos_fasilitas_custom');
    }
}
