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
    ];
    // untuk menampilkan lebih dari 1 gambar
     // Relasi dengan model GambarKamar
    public function gambarKamar()
    {
        return $this->hasMany('App\Models\GambarKamar', 'id_kamar_kos');
    }
    // Method untuk mendapatkan gambar
    public function getGambar()
    {
        // Ambil data gambar dari relasi gambarKamar
        $gambar = $this->gambarKamar->pluck('gambar')->toArray();

        return $gambar;
    }
    // Relasi dengan model Kos
    public function kos()
    {
        return $this->belongsTo('App\Models\Kos', 'id_kos');
    }
    // Relasi dengan model Pemesanan
    public function pemesanan()
    {
        return $this->hasMany('App\Models\Pemesanan', 'id_kamar_kos');
    }
    public function fasilitasCustom()
    {
        return $this->belongsToMany(FasilitasCustom::class, 'kamar_kos_fasilitas_custom', 'id_kamar_kos', 'id_fasilitas_custom');
    }
    protected $table = 'kamar_kos';
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment
}