<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan'; 
    protected $primaryKey = 'id'; 
    protected $keyType = 'string'; 
    public $incrementing = false;


    protected $fillable = [
        'kode_pemesanan',
        'nama_pemesan',
        'alamat_pemesan',
        'nomor_telepon',
        'jumlah_kamar',
        'jenis_kelamin',
        'id_user',
        'id_kamar_kos',
        'id_admin',
        'status',
        'total_pemesanan',
        'verified_by',
        'selected_fasilitas_custom',
    ];
    // Cast kolom waktu menjadi tipe data datetime
    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'selected_fasilitas_custom' => 'array',
    ];

    // Relasi dengan model User (Pemesan)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan model KamarKos
    public function kamarKos()
    {
        return $this->belongsTo(KamarKos::class, 'id_kamar_kos');
    }

    // Relasi dengan model User (Pemilik Kos)
    public function pemilikKos()
    {
        return $this->belongsTo(User::class, 'id_pemilikkos');
    }
    // Relasi dengan model Kos melalui KamarKos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kamar_kos')->with('pemilikkos');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}