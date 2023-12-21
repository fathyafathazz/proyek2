<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment
    protected $fillable = ['nama_fasilitas'];

    public function fasilitasKos()
{
    return $this->hasMany(FasilitasKos::class, 'id_fasilitas');
}

}
