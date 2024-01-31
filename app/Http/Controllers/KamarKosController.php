<?php

namespace App\Http\Controllers;

use App\Models\KamarKos;
use App\Models\Kos;
use App\Models\GambarKamar;
use App\Models\FasilitasCustom;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menampilkan data kamar kos berdasarkan id_pemilikkos (id pemilik kos)
        $data = KamarKos::whereHas('kos', function ($query) use ($user) {
            $query->where('id_pemilikkos', $user->id);
        })->get();

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
        // Ambil fasilitas yang sudah terpilih sebelumnya
        $selectedFasilitas = $data->fasilitasCustom->pluck('id')->toArray();
        return view('kamar_kos.edit', compact('kos', 'data', 'selectedFasilitas'));
    }
    public function tambahGambar($id)
    {
        // Temukan kamar kos berdasarkan ID
        $kamar = KamarKos::findOrFail($id);

        // Kirim data kamar kos ke view
        return view('kamar_kos.tambah_gambar', compact('kamar'));
    }
    public function tambahFasilitasCustom($id)
    {
        try {
            // Temukan kamar kos berdasarkan ID
            $kamar = KamarKos::findOrFail($id);

            // Mendapatkan semua fasilitas custom yang tersedia
            $fasilitasCustom = FasilitasCustom::all();

            // Kirim data kamar kos dan fasilitas custom ke view
            return view('kamar_kos.tambah_fasilitascustom', compact('kamar', 'fasilitasCustom'));
        } catch (\Exception $e) {
            // Handle exception jika terjadi kesalahan
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('kamar_kos');
        }
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
        ]);

        KamarKos::create([
            'id_kos' => $request->id_kos,
            'nomor_kamar' => $request->nomor_kamar,
            'ukuran_kamar' => $request->ukuran_kamar,
            'keterangan_kamar' => $request->keterangan_kamar,
            'harga_sewa' => $request->harga_sewa,
            'fasilitas_kamar' => $request->fasilitas_kamar,
            'jumlah_kamar_tersedia' => $request->jumlah_kamar_tersedia,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect('/kamar_kos');
    }

    public function storeGambarKamarKos(Request $request, $id)
    {
        $request->validate([
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimum 2MB per gambar
        ]);

        try {
            // Temukan kamar kos berdasarkan ID
            $kamar = KamarKos::findOrFail($id);

            // Simpan gambar
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $gambar_ekstensi = $file->extension();
                    $nama_gambar = Str::uuid()->toString() . "." . $gambar_ekstensi;

                    // Pindahkan gambar ke direktori yang diinginkan
                    $file->move(public_path('public/kamar_kos'), $nama_gambar);

                    // Simpan informasi gambar ke tabel gambar_kamar
                    GambarKamar::create(['gambar' => $nama_gambar, 'id_kamar_kos' => $kamar->id]);
                }
            }
            Session::flash('success', 'Gambar berhasil diunggah');
            return redirect()->route('kamar_kos');
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('kamar_kos');
        }
    }
    public function storeFasilitasCustom(Request $request, $id)
    {
        try {
            $kamar = KamarKos::findOrFail($id);

            $fasilitasCustom = $request->fasilitas_custom;

            foreach ($fasilitasCustom as $idFasilitasCustom) {
                $fasilitasCustom = FasilitasCustom::findOrFail($idFasilitasCustom);

                // Use attach() to save data to the pivot table
                $kamar->fasilitasCustom()->attach($fasilitasCustom);
            }

            Session::flash('success', 'Data fasilitas custom berhasil disimpan');
            return redirect()->route('kamar_kos');
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('kamar_kos', $id);
        }
    }
    public function change(Request $request)
    {
        // Ambil kamar kos berdasarkan ID
        $kamar_kos = KamarKos::find($request->id);

        // Ambil fasilitas yang sudah terpilih sebelumnya
        $selectedFasilitas = $kamar_kos->fasilitasCustom->pluck('id')->toArray();

        $request->validate([
            'id_kos' => 'required|exists:kos,id',
            'nomor_kamar' => 'required|string',
            'ukuran_kamar' => 'required|string',
            'keterangan_kamar' => 'required|string',
            'harga_sewa' => 'required|integer',
            'fasilitas_kamar' => 'required|string',
            'jumlah_kamar_tersedia' => 'required|integer',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data kamar kos
        $kamar_kos->update([
            'id_kos' => $request->id_kos,
            'nomor_kamar' => $request->nomor_kamar,
            'ukuran_kamar' => $request->ukuran_kamar,
            'keterangan_kamar' => $request->keterangan_kamar,
            'harga_sewa' => $request->harga_sewa,
            'fasilitas_kamar' => $request->fasilitas_kamar,
            'jumlah_kamar_tersedia' => $request->jumlah_kamar_tersedia,
        ]);

        // Proses upload dan simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambar_ekstensi = $file->extension();
                $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;

                // Pindahkan gambar ke direktori yang diinginkan
                $file->move(public_path('public/kamar_kos'), $nama_gambar);

                // Simpan informasi gambar ke tabel gambar_kamar
                $kamar_kos->gambarKamar()->create(['gambar' => $nama_gambar]);
            }
        }
        // Sinkronisasi fasilitas yang dipilih
        $kamar_kos->fasilitasCustom()->sync($request->fasilitas_custom);

        // Hapus fasilitas yang tidak dipilih lagi
        $kamar_kos->fasilitasCustom()->detach(array_diff($selectedFasilitas, $request->fasilitas_custom));

        Session::flash('success', 'Berhasil Mengubah Data Kos');
        return redirect('/kamar_kos');
    }
}