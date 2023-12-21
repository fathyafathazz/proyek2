<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FasilitasController extends Controller
{
    function index()
    {
        $data = Fasilitas::orderBy('nama_fasilitas')->get();
        return view('fasilitas.index', ['data' => $data]);
    }
    function tambah()
    {
        return view('fasilitas.tambah');
    }
    function edit($id)
    {
        $data = Fasilitas::find($id);
        return view('fasilitas.edit', ['data' => $data]);
    }
    function hapus(Request $request)
    {
        Fasilitas::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/fasilitas');
    }
    // new
    function create(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string',
        ]);

        $fasilitas = new Fasilitas();
        $fasilitas->id = Uuid::uuid4()->toString();
        $fasilitas->nama_fasilitas = $request->nama_fasilitas;
        $fasilitas->save();
        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/fasilitas');
    }
    function change(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string',
        ]);

        $fasilitas = Fasilitas::find($request->id);

        $fasilitas->nama_fasilitas = $request->nama_fasilitas;
        $fasilitas->save();

        Session::flash('success', 'Berhasil Mengubah Fasilitas Kos');

        return redirect('/fasilitas');
    }

}
