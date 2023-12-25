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
        // $data = Kos::with('Kategori', 'JenisKos')->orderBy('nama_kos')->get();
        return view('kos.index', ['data' => $data]);
    }

    public function tambah()
    {
        
        // $kategoris = Kategori::orderBy('nama_kategori')->get();
        // $jenis_kos = JenisKos::orderBy('nama_jenis_kos')->get();
        return view('kos.tambah'); //['kategoris' => $kategoris, 'jeniskos' => $jenis_kos]
    }


    function edit($id)
    {
        $data = Kos::find($id);
        // $kategoris = Kategori::orderBy('nama_kategori')->get();
        // $jenis_kos = JenisKos::orderBy('nama_jenis_kos')->get();
        return view('kos.edit', ['data' => $data]); //, 'kategoris' => $kategoris, 'jeniskos' => $jenis_kos
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
            // 'id_kategoris' => 'required|exists:kategoris,id',
            // 'id_jenis_kos' => 'required|exists:jenis_kos,id',
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
        
            // $kos = Kos::create([
            //     'id' => Uuid::uuid4()->toString(), // Generate UUID
            //     'nama_kos' => $request->nama_kos,
            //     'alamat_kos' => $request->alamat_kos,
            //     'keterangan_kos' => $request->keterangan_kos,
            //     'fasilitas' => $request->fasilitas,
            //     'kategori' => $request->kategori,
            //     // 'id_kategoris' => $request->id_kategoris,
            //     // 'id_jenis_kos' => $request->id_jenis_kos,
            // ]);
            // $kos->save();

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
            // 'id_kategoris' => 'required|exists:kategoris,id',
            // 'id_jenis_kos' => 'required|exists:jenis_kos,id',
            
        ]);

        $kos = Kos::find($request->id);

        $kos->nama_kos = $request->nama_kos;
        $kos->alamat_kos = $request->alamat_kos;
        $kos->keterangan_kos = $request->keterangan_kos;
        $kos->fasilitas = $request->fasilitas;
        $kos->kategori = $request->kategori;
        // $kos->id_kategoris = $request->id_kategoris;
        // $kos->id_jenis_kos = $request->id_jenis_kos;

        $kos->save();

        Session::flash('success', 'Berhasil Mengubah Data Kos');

        return redirect('/kos');
    }
}
