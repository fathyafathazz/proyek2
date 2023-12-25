<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;
use App\Models\Kos;
use App\Helpers\FormatHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class KamarKosController extends Controller
{
    public function formatRupiah($harga)
    {
        return FormatHelper::formatRupiah($harga);
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $data = KamarKos::all();
        return view('kamar_kos.index', ['data' => $data]);
    }

    public function tambah()
    {
        $kos = Kos::all();
        return view('kamar_kos.tambah', compact('kos'));
    }

    public function edit($id)
    {
        $kos = Kos::all();
        $data = KamarKos::find($id);
        return view('kamar_kos.edit', compact('kos'), ['data' => $data]);
    }

    public function hapus(Request $request)
    {
        KamarKos::where('id', $request->id)->delete();
        Session::flash('success', 'Berhasil Hapus Data');
        return redirect('/kamar_kos');
    }

    public function create(Request $request)
    {
        $request->validate([
            'id_kos' => 'required|exists:kos,id',
            'nomor_kamar' => 'required|string',
            'ukuran_kamar' => 'required|string',
            'keterangan_kamar' => 'required|string',
            'harga_sewa' => 'required|integer',
            'fasilitas_kamar' => 'required|string',
            'jumlah_kamar_tersedia' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambar_file = $request->file('gambar');
        $gambar_ekstensi = $gambar_file->extension();
        $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
        $gambar_file->move(public_path('public/kamar_kos'), $nama_gambar);

        KamarKos::create([
            'id_kos' => $request->id_kos,
            'nomor_kamar' => $request->nomor_kamar,
            'ukuran_kamar' => $request->ukuran_kamar,
            'keterangan_kamar' => $request->keterangan_kamar,
            'harga_sewa' => $request->harga_sewa,
            'fasilitas_kamar' => $request->fasilitas_kamar,
            'jumlah_kamar_tersedia' => $request->jumlah_kamar_tersedia,
            'gambar' => $nama_gambar,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect('/kamar_kos');
    }

    public function change(Request $request)
    {
        $request->validate([
            'id_kos' => 'required|exists:kos,id',
            'nomor_kamar' => 'required|string',
            'ukuran_kamar' => 'required|string',
            'keterangan_kamar' => 'required|string',
            'harga_sewa' => 'required|integer',
            'fasilitas_kamar' => 'required|string',
            'jumlah_kamar_tersedia' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kamar_kos = KamarKos::find($request->id);

        $kamar_kos->id_kos = $request->id_kos;
        $kamar_kos->nomor_kamar = $request->nomor_kamar;
        $kamar_kos->ukuran_kamar = $request->ukuran_kamar;
        $kamar_kos->keterangan_kamar = $request->keterangan_kamar;
        $kamar_kos->harga_sewa = $request->harga_sewa;
        $kamar_kos->fasilitas_kamar = $request->fasilitas_kamar;
        $kamar_kos->jumlah_kamar_tersedia = $request->jumlah_kamar_tersedia;

        $gambar_file = $request->file('gambar');
        $gambar_ekstensi = $gambar_file->extension();
        $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
        $gambar_file->move(public_path('public/kamar_kos'), $nama_gambar);

        $kamar_kos->gambar = $nama_gambar;

        $kamar_kos->save();

        Session::flash('success', 'Berhasil Mengubah Data Kos');
        return redirect('/kamar_kos');
    }
}
