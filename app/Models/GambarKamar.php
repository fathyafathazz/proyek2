<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarKamar extends Model
{
    protected $fillable = ['gambar', 'id_kamar_kos'];

    public function kamarKos()
    {
        return $this->belongsTo(KamarKos::class, 'id_kamar_kos');
    }

    protected $table = 'gambar_kamar';
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment
}
