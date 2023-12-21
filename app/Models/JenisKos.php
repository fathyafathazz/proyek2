<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Tentukan primary key
    public $incrementing = false; // Atur agar tidak auto increment
    protected $fillable = ['nama_jenis_kos'];
    protected $table = 'jenis_kos';
}
