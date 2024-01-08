<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;

class AdminController extends Controller
{
    function index(){
        // Mendapatkan total pemesanan
        $totalPemesananSudahBayar = Pemesanan::where('status', 'Sudah Bayar')->sum('total_pemesanan');

        // Mendapatkan jumlah user pemilik kos
        $jumlahPemilikKos = User::where('role', 'pemilikkos')->count();

        // Mendapatkan jumlah user pencari kos
        $jumlahPencariKos = User::where('role', 'user')->count();

        // Variabel totalUsers digunakan untuk menghitung persentase user pemilik kos
        $totalUsers = User::count();
        return view('pointakses/admin/index', [
            'totalPemesananSudahBayar' => $totalPemesananSudahBayar,
            'jumlahPemilikKos' => $jumlahPemilikKos,
            'jumlahPencariKos' => $jumlahPencariKos,
            'totalUsers' => $totalUsers, // Menambahkan variabel totalUsers
        ]);
    }
    
}

