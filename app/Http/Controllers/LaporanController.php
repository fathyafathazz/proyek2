<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::with('kamarKos.kos', 'user')->orderBy('created_at', 'desc')->get();
        return view('pointakses.admin.laporan', compact('pemesanan'));
    }

    public function pemilikKos()
    {
        // Mendapatkan ID pemilik kos saat ini
        $pemilikKosId = Auth::id();

        // Mendapatkan data pemesanan yang hanya terkait dengan kos milik pemilik kos saat ini
        $pemesanan = Pemesanan::with('kamarKos.kos', 'user')
            ->whereHas('kamarKos.kos.pemilikkos', function ($query) use ($pemilikKosId) {
                $query->where('id', $pemilikKosId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pointakses.admin.laporan', compact('pemesanan'));
    }

    public function kode(Request $request)
    {
        return redirect()->route('pointakses.admin.show', $request->kode_pemesanan);
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with('kamarKos.kos.pemilikkos', 'user')->where('kode_pemesanan', $id)->first();
        if ($pemesanan) {
            return view('pointakses.admin.show', compact('pemesanan'));
        } else {
            return redirect()->back()->with('error', 'Kode Pemesanan Tidak Ditemukan!');
        }
    }

    public function pembayaran($id)
    {
        $pemesanan = Pemesanan::with('admin')->find($id);

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Pemesanan tidak ditemukan!');
        }

        $pemesanan->update([
            'status' => 'Sudah Bayar',
            'verified_by' => Auth::user()->fullname,
        ]);

        return redirect()->back()->with('success', 'Pembayaran Kosan Success!');
    }
}
