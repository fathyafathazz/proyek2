<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Carbon::setLocale('id');

        Schema::create('pemesanan', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id_user');
            $table->uuid('id_admin')->nullable();
            $table->uuid('id_kamar_kos');
            $table->string('kode_pemesanan')->unique();
            $table->string('nama_pemesan');
            $table->text('alamat_pemesan');
            $table->string('jenis_kelamin');
            $table->string('nomor_telepon');
            $table->timestamp('tanggal_pemesanan')->useCurrent();
            $table->integer('jumlah_kamar');
            $table->integer('total_pemesanan');
            $table->enum('status', ['Belum Bayar', 'Sudah Bayar'])->default('Belum Bayar');
            $table->string('verified_by')->nullable();
            $table->timestamp('tanggal_verifikasi')->useCurrent();
            $table->timestamps();


            
            $table->foreign('id_admin')->references('id')->on('users');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_kamar_kos')->references('id')->on('kamar_kos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}
