<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasCustom extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment
    protected $table = 'fasilitas_custom';

    protected $fillable = [
        'nama',
        'harga',
    ];
    public function kamarKos()
    {
        return $this->belongsToMany(KamarKos::class, 'kamar_kos_fasilitas_custom');
    }
    // Pada model FasilitasCustom.php
    public function pemesanan()
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_fasilitas_custom', 'id_fasilitas_custom', 'id_pemesanan')
            ->withTimestamps();
    }
}
