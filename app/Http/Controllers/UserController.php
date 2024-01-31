<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;  
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $data = KamarKos::with('kos')->get();
        return view('pointakses.user.index', ['data' => $data]);  // Kirim data ke view
    }
    public function detail($id)
    {
        $id = Str::isUuid($id) ? $id : Str::uuid();

        // Mengambil detail kamar kos beserta gambar-gambar dari tabel gambar_kamar
        $kamar = KamarKos::with('kos', 'gambarKamar')->findOrFail($id);

        return view('pointakses.user.detail', ['kamar' => $kamar]);
    }
}