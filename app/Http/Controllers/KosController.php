<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Kategori;
use App\Models\JenisKos;
use App\Models\Fasilitas;
use App\Models\FasilitasKos;
use Exception;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $data = Kos::all();

        return view('kos.index', ['data' => $data]);
    }
    public function tambah()
    {
        return view('kos.tambah');
    }


    function edit($id)
    {
        $data = Kos::find($id);
        return view('kos.edit', ['data' => $data]);
    }

    function hapus(Request $request)
    {
        Kos::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/kos');
    }

    // new
    // ...

    function create(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required|string',
            'alamat_kos' => 'required|string',
            'keterangan_kos' => 'required|string',
            'fasilitas' => 'required|string',
        ]);

        $kos = new Kos();
        $kos->id = Uuid::uuid4()->toString();
        $kos->id_pemilikkos = Auth::user()->id; // Menggunakan id pemilik dari user yang sedang login
        $kos->nama_kos = $request->nama_kos;
        $kos->alamat_kos = $request->alamat_kos;
        $kos->keterangan_kos = $request->keterangan_kos;
        $kos->fasilitas = $request->fasilitas;
        $kos->kategori = $request->kategori;
        $kos->save();



        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/kos');
    }


    function change(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required|string',
            'alamat_kos' => 'required|string',
            'keterangan_kos' => 'required|string',
            'fasilitas' => 'required|string',
            'kategori' => 'required|string',

        ]);

        $kos = Kos::find($request->id);

        $kos->nama_kos = $request->nama_kos;
        $kos->alamat_kos = $request->alamat_kos;
        $kos->keterangan_kos = $request->keterangan_kos;
        $kos->fasilitas = $request->fasilitas;
        $kos->kategori = $request->kategori;

        $kos->save();

        Session::flash('success', 'Berhasil Mengubah Data Kos');

        return redirect('/kos');
    }
}
