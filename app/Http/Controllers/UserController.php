<?php

namespace App\Http\Controllers;

use App\Models\Kos;  // Import model KamarKos
use App\Models\KamarKos;  // Import model KamarKos
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

        //mengambil detail produk
        $data = KamarKos::with('kos')->findOrFail($id);
        return view('pointakses.user.detail', [ 'data' => $data]);
    }
   
}
