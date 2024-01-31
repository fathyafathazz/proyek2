<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikkosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataMahasiswa;
use App\Http\Controllers\KamarKosController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JenisKosController;
use App\Http\Controllers\FasilitasCustomController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\UproleController;
use App\Http\Controllers\UserControlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\LaporanController;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'halaman_depan/index');
view()->share('formatHelper', new FormatHelper);

Route::middleware(['guest'])->group(function () {
    Route::get('/sesi', [AuthController::class, 'index'])->name('auth');
    Route::post('/sesi', [AuthController::class, 'login']);
    Route::get('/reg', [AuthController::class, 'create'])->name('registrasi');
    Route::post('/reg', [AuthController::class, 'register']);
    Route::get('/verify/{verify_key}', [AuthController::class, 'verify']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin');
    Route::get('/pemilikkos', [PemilikkosController::class, 'index'])->name('pemilikkos')->middleware('userAkses:pemilikkos');
    Route::get('/home', [UserController::class, 'index'])->name('user')->middleware('userAkses:user');


    //user
    Route::get('/user/detail/{id}', [UserController::class, 'detail'])->name('user.detail')->middleware('userAkses:user');
    Route::get('/search', [SearchController::class, 'searchByCategory'])->name('search');
    Route::get('/transaksi/pemesanan/{id}', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/pemesanan', [PemesananController::class, 'create'])->name('checkout');
    Route::get('/history', [PemesananController::class, 'history'])->name('history');
    Route::get('/transaksi/showInvoice/{id}', [PemesananController::class, 'showInvoice'])->name('transaksi.showInvoice');

    //admin
    Route::get('/transaksi', [LaporanController::class, 'index'])->name('transaksi');
    Route::get('/transaksi/{kode}', [LaporanController::class, 'show'])->name('transaksi.show');
    Route::get('/pembayaran/{id}', [LaporanController::class, 'pembayaran'])->name('pembayaran');
    //uprole
    Route::post('/uprole/{id}', [UproleController::class, 'index']);
     //usercontrol
     Route::get('/usercontrol', [UserControlController::class, 'index'])->name('usercontrol');
     Route::get('/tambahuc', [UserControlController::class, 'tambah']);
     Route::get('/edituc/{id}', [UserControlController::class, 'edit']);
     Route::post('/hapusuc/{id}', [UserControlController::class, 'hapus']);
     Route::post('/tambahuc', [UserControlController::class, 'create']);
     Route::post('/edituc', [UserControlController::class, 'change']);

     
    //pemilikkos
    Route::get('/pesanan', [LaporanController::class, 'pemilikKos'])->name('pesanan');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    //kos
    Route::get('/kos', [KosController::class, 'index'])->name('kos');
    Route::get('/kostambah', [KosController::class, 'tambah']);
    Route::post('/tambahkos', [KosController::class, 'create']);
    Route::get('/kosedit/{id}', [KosController::class, 'edit']);
    Route::post('/editkos', [KosController::class, 'change']);
    Route::post('/koshapus/{id}', [KosController::class, 'hapus']);

    //kamar kos
    Route::get('/kamar_kos', [KamarKosController::class, 'index'])->name('kamar_kos');
    Route::get('/kamarkostambah/', [KamarKosController::class, 'tambah']);
    Route::post('/tambahkamarkos', [KamarKosController::class, 'create']);
    Route::get('/kamarkosedit/{id}', [KamarKosController::class, 'edit']);
    Route::post('/editkamarkos', [KamarKosController::class, 'change']);
    Route::post('/kamarkoshapus/{id}', [KamarKosController::class, 'hapus']);
    Route::get('/kamar_kos/{id}/tambah-gambar', [KamarKosController::class, 'tambahGambar'])->name('kamar_kos.tambah_gambar');
    Route::post('/kamar_kos/store/gambar/{id}', [KamarKosController::class, 'storeGambarKamarKos'])->name('kamar_kos.store.gambar');
    Route::get('/kamar_kos/tambah_fasilitascustom/{id}', [KamarKosController::class, 'tambahFasilitasCustom'])->name('kamar_kos.tambah_fasilitascustom');
    Route::post('/kamar_kos/{id}/fasilitas_custom', [KamarKosController::class, 'storeFasilitasCustom'])->name('kamar_kos.storeFasilitasCustom');

    //fasilitas custom
    Route::get('/fasilitas_custom', [FasilitasCustomController::class, 'index'])->name('fasilitas_custom');
    Route::get('/fasilitas_customtambah/', [FasilitasCustomController::class, 'tambah']);
    Route::post('/tambahfasilitas_custom', [FasilitasCustomController::class, 'create']);
    Route::get('/fasilitas_customedit/{id}', [FasilitasCustomController::class, 'edit']);
    Route::post('/editfasilitas_custom', [FasilitasCustomController::class, 'change']);
    Route::post('/fasilitas_customhapus/{id}', [FasilitasCustomController::class, 'hapus']);
});
