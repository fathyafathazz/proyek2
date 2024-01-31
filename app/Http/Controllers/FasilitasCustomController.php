<?php

namespace App\Http\Controllers;

use App\Models\FasilitasCustom;
use Illuminate\Http\Request;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\Session;

class FasilitasCustomController extends Controller
{
    public function formatRupiah($harga)
    {
        return FormatHelper::formatRupiah($harga);
    }
    function index()
    {
        $data = FasilitasCustom::orderBy('nama')->get();
        return view('fasilitas_custom.index', ['data' => $data]);
    }
    function tambah()
    {
        return view('fasilitas_custom.tambah');
    }
    function edit($id)
    {
        $data = FasilitasCustom::find($id);
        return view('fasilitas_custom.edit', ['data' => $data]);
    }
    function hapus(Request $request)
    {
        FasilitasCustom::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/fasilitas_custom');
    }
    // new
    function create(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $fasilitascustom = new FasilitasCustom();
        $fasilitascustom->nama = $request->nama;
        $fasilitascustom->harga = $request->harga;
        $fasilitascustom->save();
        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/fasilitas_custom');
    }
    function change(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $fasilitascustom = FasilitasCustom::find($request->id);

        $fasilitascustom->nama = $request->nama;
        $fasilitascustom->harga = $request->harga;
        $fasilitascustom->save();

        Session::flash('success', 'Berhasil Mengubah Fasilitas Kos');

        return redirect('/fasilitas_custom');
    }
}

