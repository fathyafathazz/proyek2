<?php
namespace App\Http\Controllers;

use App\Models\DataMahasiswa as ModelsDataMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataMahasiswa extends Controller
{
    function index(){
        $data = ModelsDataMahasiswa::all();
        return view('data_mahasiswa.index', ['data'=> $data]);
    }
    function tambah(){
        return view('data_mahasiswa.tambah');
    }
    function edit($id){
        $data = ModelsDataMahasiswa::find($id);
        return view('data_mahasiswa.edit', ['data' => $data]);
    }
    function hapus(Request $request){
        ModelsDataMahasiswa::where('id', $request->id)->delete();

        Session::flash('success','Berhasil Hapus Data');

        return redirect('/datamahasiswa');

    }
    // new
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'npm' => 'required|max:9',
            'angkatan' => 'required|min:2|max:2',
            'jurusan' => 'required',
        ], [
            'name.required' => 'Name Wajib Di isi',
            'name.min' => 'Bidang name minimal harus 3 karakter.',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'npm.required' => 'NPM Wajib Di isi',
            'npm.max' => 'NPM max 9 Digit',
            'angkatan.required' => 'Angkatan Wajib Di isi',
            'angkatan.min' => 'Masukan 2 angka Akhir dari Tahun misal: 2022 (22)',
            'angkatan.max' => 'Masukan 2 angka Akhir dari Tahun misal: 2022 (22)',
            'jurusan.required' => 'Jurusan Wajib Di isi',
        ]);

        ModelsDataMahasiswa::insert([
            'name' => $request->name,
            'email' => $request->email,
            'npm' => $request->npm,
            'angkatan' => $request->angkatan,
            'jurusan' => $request->jurusan,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/datamahasiswa')->with('success', 'Berhasil Menambahkan Data');
    }
    function change(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'npm' => 'required|min:9|max:9',
            'angkatan' => 'required|min:2|max:2',
            'jurusan' => 'required',
        ], [
            'name.required' => 'Name Wajib Di isi',
            'name.min' => 'Bidang name minimal harus 3 karakter.',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'npm.required' => 'NPM Wajib Di isi',
            'npm.max' => 'NPM max 9 Digit',
            'npm.min' => 'NPM min 9 Digit',
            'angkatan.required' => 'Angkatan Wajib Di isi',
            'angkatan.min' => 'Masukan 2 angka Akhir dari Tahun misal: 2022 (22)',
            'angkatan.max' => 'Masukan 2 angka Akhir dari Tahun misal: 2022 (22)',
            'jurusan.required' => 'Jurusan Wajib Di isi',
        ]);

        $datamahasiswa = ModelsDataMahasiswa::find($request->id);

        $datamahasiswa->name = $request->name;
        $datamahasiswa->email = $request->email;
        $datamahasiswa->npm = $request->npm;
        $datamahasiswa->angkatan = $request->angkatan;
        $datamahasiswa->jurusan = $request->jurusan;
        $datamahasiswa->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/datamahasiswa');
    }
}
