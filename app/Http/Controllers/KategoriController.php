<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    function index()
    {
        $data = Kategori::orderBy('nama_kategori')->get();
        return view('kategori.index', ['data' => $data]);
    }

    function tambah()
    {
        return view('kategori.tambah');
    }

    function edit($id)
    {
        $data = Kategori::find($id);
        return view('kategori.edit', ['data' => $data]);
    }

    function hapus(Request $request)
    {
        Kategori::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/kategori');
    }

    // new
    function create(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        $kategoris = new Kategori();
        $kategoris->id = Uuid::uuid4()->toString();
        $kategoris->nama_kategori = $request->nama_kategori;
        $kategoris->save();

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/kategori');
    }

    function change(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        $kategoris = Kategori::find($request->id);

        $kategoris->nama_kategori = $request->nama_kategori;
        $kategoris->save();

        Session::flash('success', 'Berhasil Mengubah Kategori');

        return redirect('/kategori');
    }
}
