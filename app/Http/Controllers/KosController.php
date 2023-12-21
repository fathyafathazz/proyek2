<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Kategori;
use App\Models\JenisKos;
use App\Models\Fasilitas;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KosController extends Controller
{
    function index()
    {
        $data = Kos::orderBy('nama_kos')->get();
        $data = Kos::with('Kategori', 'JenisKos')->orderBy('nama_kos')->get();
        return view('kos.index', ['data' => $data]);
    }

    function tambah()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $jenis_kos = JenisKos::orderBy('nama_jenis_kos')->get();
        // $fasilitas = Fasilitas::orderBy('nama_fasilitas')->get();
        return view('kos.tambah', ['kategoris' => $kategoris, 'jeniskos' => $jenis_kos, ]); //'fasilitas' => $fasilitas
    }

    function edit($id)
    {
        $data = Kos::find($id);
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $jenis_kos = JenisKos::orderBy('nama_jenis_kos')->get();
        return view('kos.edit', ['data' => $data, 'kategoris' => $kategoris, 'jeniskos' => $jenis_kos]);
    }

    function hapus(Request $request)
    {
        Kos::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/kos');
    }

    // new
    function create(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required|string',
            'alamat_kos' => 'required|string',
            'deskripsi_kos' => 'required|string',
            'id_kategoris' => 'required|exists:kategoris,id',
            'id_jenis_kos' => 'required|exists:jenis_kos,id',
            // 'fasilitas' => 'required|array',
            // 'fasilitas.*' => 'exists:fasilitas,id',
        ]);

        // DB::beginTransaction();

        // try {
            // $kos = Kos::create([
            //     'nama_kos' => $request->nama_kos,
            //     'alamat_kos' => $request->alamat_kos,
            //     'deskripsi_kos' => $request->deskripsi_kos,
            //     'id_kategoris' => $request->id_kategoris,
            //     'id_jenis_kos' => $request->id_jenis_kos,
            // ]);

            $kos = new Kos();
            $kos->id = Uuid::uuid4()->toString();
            $kos->nama_kos = $request->nama_kos;
            $kos->alamat_kos = $request->alamat_kos;
            $kos->deskripsi_kos = $request->deskripsi_kos;
            $kos->id_kategoris = $request->id_kategoris;
            $kos->id_jenis_kos = $request->id_jenis_kos;
            $kos->save();

            // $kos->fasilitas()->sync($request->fasilitas);

            // DB::commit();

            Session::flash('success', 'Data berhasil ditambahkan');
            return redirect('/kos');
        // } 
        // catch (\Exception $e) {
        //     DB::rollBack();
        //     Session::flash('error', $e->getMessage());
        //     return redirect()->back();
        // }
    }

    function change(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required|string',
            'alamat_kos' => 'required|string',
            'deskripsi_kos' => 'required|string',
            'id_kategoris' => 'required|exists:kategoris,id',
            'id_jenis_kos' => 'required|exists:jenis_kos,id',
            // 'fasilitas' => 'required|array',
            // 'fasilitas.*' => 'exists:fasilitas,id',
        ]);

        $kos = Kos::find($request->id);

        $kos->nama_kos = $request->nama_kos;
        $kos->alamat_kos = $request->alamat_kos;
        $kos->deskripsi_kos = $request->deskripsi_kos;
        $kos->id_kategoris = $request->id_kategoris;
        $kos->id_jenis_kos = $request->id_jenis_kos;

        $kos->save();

        Session::flash('success', 'Berhasil Mengubah Kategori');

        return redirect('/kos');
    }
}
