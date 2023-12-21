<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasKamar extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment

    protected $fillable = ['nama_fasilitas_kamar', 'id_fasilitas']; //'id_kamar_kos'
    // tambahkan fillable untuk kolom lain yang dapat diisi

    protected $table = 'fasilitas_kamar';
}
