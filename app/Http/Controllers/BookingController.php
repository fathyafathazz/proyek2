<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function booking(Request $request, $id)
    {
        // Validasi form booking
        $request->validate([
            'jumlah_kamar_tersedia' => 'required|integer|min:1',
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        // Ambil data kamar kos
        $data = KamarKos::findOrFail($id);

        // Simpan pemesanan
        $this->createPemesanan([
            'id_user' => Auth::user()->id,
            'id_kamar_kos' => $data->id,
            'jumlah_kamar' => $request->jumlah_kamar_tersedia,
            'harag_sewa' => $data->harga_sewa, // tambahkan harga kamar ke dalam data pemesanan
            'total_pemesanan' => $data->harga_sewa * $request->jumlah_kamar_tersedia, // tambahkan total harga ke dalam data pemesanan
            'status' => 'Belum Bayar',
            // tambahkan field lain sesuai kebutuhan
        ]);

        // Redirect atau kirim notifikasi ke halaman invoice pemesanan
        return redirect()->route('invoice', ['id' => $data->id])
            ->with('success', 'Booking berhasil!');

        // Jika ingin merubah jumlah kamar tersedia di model KamarKos, tambahkan kode berikut:
        // $data->jumlah_kamar_tersedia = $data->jumlah_kamar_tersedia - $request->jumlah_kamar_tersedia;
        // $data->save();
    }
}
