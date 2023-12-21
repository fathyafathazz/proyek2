<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class FasilitasKamarController extends Controller
{
    function index()
    {
        $data = FasilitasKamar::orderBy('nama_fasilitas_kamar')->get();
        return view('fasilitas_kamar.index', ['data' => $data]);
    }

    function tambah()
    {
        return view('fasilitas_kamar.tambah');
    }

    function edit($id)
    {
        $data = FasilitasKamar::find($id);
        return view('fasilitas_kamar.edit', ['data' => $data]);
    }

    function hapus(Request $request)
    {
        FasilitasKamar::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/fasilitas_kamar');
    }

    // new
    function create(Request $request)
    {
        $request->validate([
            'nama_fasilitas_kamar' => 'required|string',
        ]);

        $fasilitas_kamar = new FasilitasKamar();
        $fasilitas_kamar->id = Uuid::uuid4()->toString();
        $fasilitas_kamar->nama_fasilitas_kamar = $request->nama_fasilitas_kamar;
        $fasilitas_kamar->save();

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/fasilitas_kamar');
    }

    function change(Request $request)
    {
        $request->validate([
            'nama_fasilitas_kamar' => 'required|string',
        ]);

        $fasilitas_kamar = FasilitasKamar::find($request->id);

        $fasilitas_kamar->nama_fasilitas_kamar = $request->nama_fasilitas_kamar;
        $fasilitas_kamar->save();

        Session::flash('success', 'Berhasil Mengubah fasilitas_kamar');

        return redirect('/fasilitas_kamar');
    }

}
