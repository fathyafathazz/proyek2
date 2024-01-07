<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;
use App\Models\Kos;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemilikkosController extends Controller
{
    function index(){
        $jumlahKamarKos = KamarKos::count();
        $jumlahKos = Kos::count();
        $totalPemesanan = Pemesanan::sum('total_pemesanan');
        return view('pointakses/pemilikkos/index',[ 'jumlahKamarKos' => $jumlahKamarKos, 'jumlahKos' => $jumlahKos, 'totalPemesanan' => $totalPemesanan]);
    }
}
