<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByCategory(Request $request)
    {
        // Mendapatkan nilai dari input form
        $query = $request->input('query');
        $kategori = $request->input('kategori');

        // Query berdasarkan kategori dan query pencarian
        $kamarKos = KamarKos::query();

        // Filter berdasarkan kategori jika dipilih
        if ($kategori) {
            $kamarKos->whereHas('kos', function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            });
        }

        // Filter berdasarkan pencarian teks jika ada
        if ($query) {
            $kamarKos->where(function ($q) use ($query) {
                $q->where('nomor_kamar', 'like', '%' . $query . '%')
                    ->orWhere('ukuran_kamar', 'like', '%' . $query . '%')
                    ->orWhereHas('kos', function ($query) use ($query) {
                        $query->where('alamat_kos', 'like', '%' . $query . '%')
                            ->orWhere('nama_kos', 'like', '%' . $query . '%');
                        
                    })
                    ->orWhere('harga_sewa', 'like', '%' . $query . '%');
            });
        }

        // Ambil hasil query beserta relasinya
        $result = $kamarKos->with('kos')->get();

        
        return view('search.result', ['result' => $result]);
    }
}
