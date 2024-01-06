<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    // public function index()
    // {
    //     $pemesanan = Pemesanan::with('kamar_kos', 'user')->orderBy('created_at', 'desc')->get();
    //     return view('transaksi.invoice', compact('pemesanan'));
    // }

    // public function pemilikKos()
    // {
    //     return view('pointakses.pemilikkos.laporan');
    // }

    // public function kode(Request $request)
    // {
    //     return redirect()->route('transaksi.invoice', $request->kode_pemesanan);
    // }

    // public function show($id)
    // {
    //     $data = Pemesanan::with('kamar_kos.kos.pemilikkos', 'user')->where('kode_pemesanan', $id)->first();
    //     if ($data) {
    //         return view('transaksi.invoice', compact('data'));
    //     } else {
    //         return redirect()->back()->with('error', 'Kode Pemesanan Tidak Ditemukan!');
    //     }
    // }

    // public function pembayaran($id)
    // {
    //     Pemesanan::find($id)->update([
    //         'status' => 'Sudah Bayar',
    //         'id_admin' => Auth::user()->id
    //     ]);

    //     return redirect()->back()->with('success', 'Pembayaran Kosan Success!');
    // }

    // public function history()
    // {
    //     $pemesanan = Pemesanan::with('kamar_kos.')->where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    //     return view('pointakses.user.history', compact('pemesanan'));
    // }
 }
