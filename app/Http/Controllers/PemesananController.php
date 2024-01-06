<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\KamarKos;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index($id)
    {
        $data = KamarKos::findOrFail($id);

        return view('transaksi.pemesanan', ['data' => $data]);
    }

    public function create(Request $request)
    { 
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'nomor_telepon' => 'required',
            'jumlah_kamar' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'id_kamar_kos' => 'required|numeric|exists:kamar_kos,id',
        ]);
        

        $data = KamarKos::findOrFail($request->id_kamar_kos);

        $kodePemesanan = Str::random(7);

        $method = $request->method();
        dd($method);
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
            'tanggal_pemesanan' => Carbon::now(),
            'total_pemesanan' => $data->harga_sewa * $request->jumlah_kamar,
        ];

        $pemesanan = Pemesanan::create($pemesananData);

        return redirect()->route('invoice', ['id' => $pemesanan->id]);
    }

    public function showInvoice($id)
    {
        $pemesanan = Pemesanan::with('kamar_kos.kos')->findOrFail($id);

        return view('transaksi.invoice', ['pemesanan' => $pemesanan]);
    }
}
