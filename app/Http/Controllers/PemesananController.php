<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\KamarKos;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index($id)
    {
        $data = KamarKos::findOrFail($id);

        return view('transaksi.pemesanan', ['data' => $data]);
    }

    public function history()
    {
        // Ambil data pemesanan berdasarkan id_user dari pengguna yang sedang login
        $historyPemesanan = Pemesanan::with('kamarKos.kos')
            ->where('id_user', Auth::user()->id)
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();
        // Tampilkan data sebelum menggunakan dd()
        // foreach ($historyPemesanan as $pemesanan) {
        //     dd($pemesanan->toArray());
        return view('pointakses.user.history', ['historyPemesanan' => $historyPemesanan]);
    }



    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'nama_pemesan' => 'required',
    //         'alamat_pemesan' => 'required',
    //         'nomor_telepon' => 'required',
    //         'jumlah_kamar' => 'required|numeric',
    //         'jenis_kelamin' => 'required',
    //         'id_kamar_kos' => 'required|string|uuid|exists:kamar_kos,id',
    //     ]);

    //     $data = KamarKos::findOrFail($request->id_kamar_kos);

    //     $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    //     $kodePemesanan = strtoupper(substr(str_shuffle($huruf), 0, 7));

    //     $pemesananData = [
    //         'kode_pemesanan' => $kodePemesanan,
    //         'nama_pemesan' => $request->nama_pemesan,
    //         'alamat_pemesan' => $request->alamat_pemesan,
    //         'nomor_telepon' => $request->nomor_telepon,
    //         'jumlah_kamar' => $request->jumlah_kamar,
    //         'jenis_kelamin' => $request->jenis_kelamin,
    //         'id_user' => Auth::user()->id,
    //         'id_kamar_kos' => $request->id_kamar_kos,
    //         'status' => 'Belum Bayar',
    //         'tanggal_pemesanan' => Carbon::now(),
    //         'total_pemesanan' => $data->harga_sewa * $request->jumlah_kamar,
    //     ];

    //     $pemesanan = Pemesanan::create($pemesananData);

    //     return redirect()->route('history');
    // }

    // ...

    public function create(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'nomor_telepon' => 'required',
            'jumlah_kamar' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'id_kamar_kos' => 'required|string|uuid|exists:kamar_kos,id',
        ]);

        $data = KamarKos::findOrFail($request->id_kamar_kos);

        // Cek apakah jumlah kamar yang dipesan lebih kecil atau sama dengan kamar yang tersedia
        if ($request->jumlah_kamar <= $data->jumlah_kamar_tersedia) {
            $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $kodePemesanan = strtoupper(substr(str_shuffle($huruf), 0, 7));

            $pemesananData = [
                'kode_pemesanan' => $kodePemesanan,
                'nama_pemesan' => $request->nama_pemesan,
                'alamat_pemesan' => $request->alamat_pemesan,
                'nomor_telepon' => $request->nomor_telepon,
                'jumlah_kamar' => $request->jumlah_kamar,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_user' => Auth::user()->id,
                'id_kamar_kos' => $request->id_kamar_kos,
                'status' => 'Belum Bayar',
                'tanggal_pemesanan' => now(), // Menggunakan now() untuk mendapatkan tanggal dan waktu saat ini
                'total_pemesanan' => $data->harga_sewa * $request->jumlah_kamar,
            ];

            $pemesanan = Pemesanan::create($pemesananData);

            // Mengurangi jumlah kamar yang tersedia
            $data->jumlah_kamar_tersedia -= $request->jumlah_kamar;
            $data->save();

            return redirect()->route('history');
        } else {
            return back()->with('error', 'Jumlah kamar yang dipesan melebihi ketersediaan.');
        }
    }


    public function showInvoice($id)
    {
        $pemesanan = Pemesanan::with('kamarKos.kos')->findOrFail($id);

        return view('transaksi.invoice', ['pemesanan' => $pemesanan]);
    }
}
