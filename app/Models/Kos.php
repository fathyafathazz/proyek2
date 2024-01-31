<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment
    protected $fillable = ['nama_kos', 'alamat_kos', 'keterangan_kos', 'fasilitas', 'kategori', 'id_pemilikkos' ];
    public function pemilikkos()
    {
        return $this->belongsTo('App\Models\User', 'id_pemilikkos');
    }

    public function kamarKos()
    {
        return $this->hasMany(KamarKos::class, 'id_kos');
    }   
    protected $table = 'kos';
}
