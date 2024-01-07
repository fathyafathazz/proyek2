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
        Schema::table('pemesanan', function (Blueprint $table) {
            // Menambah kolom 'id_admin' ke tabel 'pemesanan' sebagai CHAR
            $table->char('id_admin', 36)->nullable()->after('id_user');

            // Menambah foreign key ke kolom 'id_admin' yang merujuk ke kolom 'id' pada tabel 'users'
            $table->foreign('id_admin')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            
                $table->dropForeign(['id_admin']);
                $table->dropColumn('id_admin');
        
        });
    }
};
