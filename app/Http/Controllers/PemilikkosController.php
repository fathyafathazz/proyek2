<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;
use Illuminate\Http\Request;

class PemilikkosController extends Controller
{
    function index(){
        $jumlahKamarKos = KamarKos::count();
        return view('pointakses/pemilikkos/index',[ 'jumlahKamarKos' => $jumlahKamarKos]);
    }
}
