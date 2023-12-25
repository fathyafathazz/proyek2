<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikkosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataMahasiswa;
use App\Http\Controllers\KamarKosController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JenisKosController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\UproleController;
use App\Http\Controllers\UserControlController;
use App\Http\Controllers\UserController;
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
    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('userAkses:user');

    //uprole
    Route::post('/uprole/{id}', [UproleController::class, 'index']);

    //usercontrol
    Route::get('/usercontrol', [UserControlController::class, 'index'])->name('usercontrol');
    Route::get('/tambahuc', [UserControlController::class, 'tambah']);
    Route::get('/edituc/{id}', [UserControlController::class, 'edit']);
    Route::post('/hapusuc/{id}', [UserControlController::class, 'hapus']);
    Route::post('/tambahuc', [UserControlController::class, 'create']);
    Route::post('/edituc', [UserControlController::class, 'change']);

    Route::get('/datamahasiswa', [DataMahasiswa::class, 'index'])->name('datamahasiswa');
    Route::get('/damatambah/', [DataMahasiswa::class, 'tambah']);
    Route::post('/tambahdama', [DataMahasiswa::class, 'create']);
    Route::get('/damaedit/{id}', [DataMahasiswa::class, 'edit']);
    Route::post('/editdama', [DataMahasiswa::class, 'change']);
    Route::post('/damahapus/{id}', [DataMahasiswa::class, 'hapus']);
    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    //kategori kos
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategoritambah/', [KategoriController::class, 'tambah']);
    Route::post('/tambahkategori', [KategoriController::class, 'create']);
    Route::get('/kategoriedit/{id}', [KategoriController::class, 'edit']);
    Route::post('/editkategori', [KategoriController::class, 'change']);
    Route::post('/kategorihapus/{id}', [KategoriController::class, 'hapus']);

    //jenis kos
    Route::get('/jenis_kos', [JenisKosController::class, 'index'])->name('jenis_kos');
    Route::get('/jeniskostambah/', [JenisKosController::class, 'tambah']);
    Route::post('/tambahjeniskos', [JenisKosController::class, 'create']);
    Route::get('/jeniskosedit/{id}', [JenisKosController::class, 'edit']);
    Route::post('/editjeniskos', [JenisKosController::class, 'change']);
    Route::post('/jeniskoshapus/{id}', [JenisKosController::class, 'hapus']);

    // //fasilitas kos
    // Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    // Route::get('/fasilitastambah/', [FasilitasController::class, 'tambah']);
    // Route::post('/tambahfasilitas', [FasilitasController::class, 'create']);
    // Route::get('/fasilitasedit/{id}', [FasilitasController::class, 'edit']);
    // Route::post('/editfasilitas', [FasilitasController::class, 'change']);
    // Route::post('/fasilitashapus/{id}', [FasilitasController::class, 'hapus']);

    // //fasilitas kamar
    // Route::get('/fasilitas_kamar', [FasilitasKamarController::class, 'index'])->name('fasilitas_kamar');
    // Route::get('/fasilitaskamartambah/', [FasilitasKamarController::class, 'tambah']);
    // Route::post('/tambahfasilitaskamar', [FasilitasKamarController::class, 'create']);
    // Route::get('/fasilitasamaredit/{id}', [FasilitasKamarController::class, 'edit']);
    // Route::post('/editfasilitaskamar', [FasilitasKamarController::class, 'change']);
    // Route::post('/fasilitaskamarhapus/{id}', [FasilitasKamarController::class, 'hapus']);

    //kos
    Route::get('/kos', [KosController::class, 'index'])->name('kos');
    Route::get('/kostambah/', [KosController::class, 'tambah']);
    Route::post('/tambahkos', [KosController::class, 'create']);
    Route::get('/kosedit/{id}', [KosController::class, 'edit']);
    Route::post('/editkos', [KosController::class, 'change']);
    Route::post('/koshapus/{id}', [KosController::class, 'hapus']);
    // Route::get('tambahkos/{id}', [KosController::class, 'gettambahkos'])->name('gettambahkos');
    //kamar kos
    Route::get('/kamar_kos', [KamarKosController::class, 'index'])->name('kamar_kos');
    Route::get('/kamarkostambah/', [KamarKosController::class, 'tambah']);
    Route::post('/tambahkamarkos', [KamarKosController::class, 'create']);
    Route::get('/kamarkosedit/{id}', [KamarKosController::class, 'edit']);
    Route::post('/editkamarkos', [KamarKosController::class, 'change']);
    Route::post('/kamarkoshapus/{id}', [KamarKosController::class, 'hapus']);
});
