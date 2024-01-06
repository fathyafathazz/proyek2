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
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'pemilikkos', 'user']);           //role ada 2, tapi bisa aja ada 3 atau lebih ->default('user');
            $table->string('gambar'); //untuk masukkan gambar, dikasi string biar cuma namanya doangyg muncul soalnya kalo gambar nanti beratt
            $table->string('verify_key'); //untuk xampp
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
