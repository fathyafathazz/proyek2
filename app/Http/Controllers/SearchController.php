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

        // ...
        $kamarKos = KamarKos::query();

        if ($kategori) {
            $kamarKos->whereHas('kos', function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            });
        }

        if ($query) {
            $kamarKos->where(function ($q) use ($query) {
                $q->where('nomor_kamar', 'like', '%' . $query . '%')
                    ->orWhere('ukuran_kamar', 'like', '%' . $query . '%')
                    ->orWhereHas('kos', function ($innerQuery) use ($query) {
                        $innerQuery->where('alamat_kos', 'like', '%' . $query . '%')
                            ->orWhere('nama_kos', 'like', '%' . $query . '%');
                    })
                    ->orWhere('harga_sewa', 'like', '%' . $query . '%');
            });
        }

        // Eager loading
        $result = $kamarKos->with('kos')->paginate(10); // Menggunakan pagination

        return view('search.result', ['result' => $result]);
    }
}
