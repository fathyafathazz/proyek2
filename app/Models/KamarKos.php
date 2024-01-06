<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarKos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kos',
        'nomor_kamar',
        'ukuran_kamar',
        'keterangan_kamar',
        'harga_sewa',
        'fasilitas_kamar',
        'jumlah_kamar_tersedia',
        'gambar',
    ];

    // Relasi dengan model Kos
    public function kos()
    {
        return $this->belongsTo('App\Models\Kos', 'id_kos');
    }
    protected $table = 'kamar_kos';
     protected $primaryKey = 'id'; // Tentukan primary key
     public $incrementing = false; // Atur agar tidak auto increment

}
