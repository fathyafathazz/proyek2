<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\KamarKos;
use App\Models\FasilitasCustom;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index($id)
    {
        $data = KamarKos::findOrFail($id);

        return view('transaksi.pemesanan', ['data' => $data]);
    }
    public function history()
    {
        // Ambil data pemesanan berdasarkan id_user dari pengguna yang sedang login
        $historyPemesanan = Pemesanan::with(['kamarKos.kos'])
            ->where('id_user', Auth::user()->id)
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();

        return view('pointakses.user.history', ['historyPemesanan' => $historyPemesanan]);
    }
    public function create(Request $request)
    {
        $data = KamarKos::findOrFail($request->id_kamar_kos);
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'nomor_telepon' => 'required',
            'jumlah_kamar' => 'required|integer|max:' . $data->jumlah_kamar_tersedia,
            'jenis_kelamin' => 'required',
            'id_kamar_kos' => 'required|string|uuid|exists:kamar_kos,id',
        ], [
            'jumlah_kamar.max' => 'Jumlah kamar tidak boleh lebih dari ' . $data->jumlah_kamar_tersedia . '.',
        ]);

        // Validasi apakah jumlah kamar yang diminta tidak melebihi ketersediaan
        if ($request->jumlah_kamar > $data->jumlah_kamar_tersedia) {
            return back()->with('error', 'Jumlah kamar yang dipesan melebihi ketersediaan.');
        }

        $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $kodePemesanan = strtoupper(substr(str_shuffle($huruf), 0, 7));

        // Hitung total pemesanan berdasarkan jumlah kamar, harga sewa, dan biaya fasilitas custom
        $totalPemesanan = ($data->harga_sewa * $request->jumlah_kamar) + $this->hitungBiayaFasilitasCustom($request->input('fasilitas_custom', []));

        $pemesananData = [
            'kode_pemesanan' => $kodePemesanan,
            'nama_pemesan' => $request->nama_pemesan,
            'alamat_pemesan' => $request->alamat_pemesan,
            'nomor_telepon' => $request->nomor_telepon,
            'jumlah_kamar' => $request->jumlah_kamar,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => Auth::user()->id,
            'id_kamar_kos' => $request->id_kamar_kos,
            'status' => 'Belum Bayar',
            'tanggal_pemesanan' => now(),
            'total_pemesanan' => $totalPemesanan,
            'selected_fasilitas_custom' => $request->input('fasilitas_custom', []), // Use an empty array if null
        ];

        $pemesanan = Pemesanan::create($pemesananData);

        // Menambahkan biaya fasilitas custom yang dipilih
        $biayaFasilitasCustom = $this->hitungBiayaFasilitasCustom($request->fasilitas_custom);

        // Menambahkan biaya fasilitas custom ke total pemesanan
        $pemesanan->total_pemesanan += $biayaFasilitasCustom;
        $pemesanan->save();

        // Mengurangi jumlah kamar yang tersedia
        $data->jumlah_kamar_tersedia -= $request->jumlah_kamar;
        $data->save();

        return redirect()->route('history');
    }
    // Fungsi untuk menghitung biaya fasilitas custom yang dipilih
    private function hitungBiayaFasilitasCustom($fasilitasCustom)
    {
        $totalBiaya = 0;

        // Ambil data fasilitas custom berdasarkan id
        $selectedFasilitas = FasilitasCustom::whereIn('id', $fasilitasCustom)->get();

        foreach ($selectedFasilitas as $fasilitas) {
            $totalBiaya += $fasilitas->harga;
        }

        return $totalBiaya;
    }
    public function showInvoice($id)
    {
        $pemesanan = Pemesanan::with('kamarKos.kos')->findOrFail($id);
        $totalPemesanan = $pemesanan->total_pemesanan;

        return view('transaksi.invoice', ['pemesanan' => $pemesanan, 'totalPemesanan' => $totalPemesanan]);
    }
}