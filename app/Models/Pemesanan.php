<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan'; // sesuaikan dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id'; // Tentukan primary key
    protected $keyType = 'string'; // Tentukan tipe data primary key
    public $incrementing = false; // Non-aktifkan auto-increment untuk primary key


    protected $fillable = [
        'kode_pemesanan',
        'nama_pemesan',
        'alamat_pemesan',
        'nomor_telepon',
        'jumlah_kamar',
        'jenis_kelamin',
        'id_user',
        'id_kamar_kos',
        'status',
        'total_pemesanan',
    ];
    // Cast kolom waktu menjadi tipe data datetime
    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
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

