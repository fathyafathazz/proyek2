<?php

namespace App\Http\Controllers;

use App\Models\JenisKos;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JenisKosController extends Controller
{
    function index()
    {
        $data = JenisKos::orderBy('nama_jenis_kos')->get();
        return view('jenis_kos.index', ['data' => $data]);
    }
    function tambah()
    {
        return view('jenis_kos.tambah');
    }
    function edit($id)
    {
        $data = JenisKos::find($id);
        return view('jenis_kos.edit', ['data' => $data]);
    }
    function hapus(Request $request)
    {
        JenisKos::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/jenis_kos');
    }
    // new
    function create(Request $request)
    {
        $request->validate([
            'nama_jenis_kos' => 'required|string',
        ]);

        $jenis_kos = new JenisKos();
        $jenis_kos->id = Uuid::uuid4()->toString();
        $jenis_kos->nama_jenis_kos = $request->nama_jenis_kos;
        $jenis_kos->save();

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/jenis_kos');
    }
    function change(Request $request)
    {
        $request->validate([
            'nama_jenis_kos' => 'required|string',
        ]);

        $jenis_kos = JenisKos::find($request->id);

        $jenis_kos->nama_jenis_kos = $request->nama_jenis_kos;
        $jenis_kos->save();

        Session::flash('success', 'Berhasil Mengubah Jenis Kos');

        return redirect('/jenis_kos');
    }
}
