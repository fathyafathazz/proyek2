<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    function index()
    {
        return view('halaman_auth/login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->email_verified_at != null) {
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin')->with('success', 'Halo Admin, Anda berhasil login');
                } else if (Auth::user()->role === 'pemilikkos') {
                    return redirect()->route('pemilikkos')->with('success', 'Berhasil login');
                } else if (Auth::user()->role === 'user') {
                    return redirect()->route('user')->with('success', 'Berhasil login');
                }
                } else{
                    Auth::logout();
                    return redirect()->route('auth')->withErrors('Akun Anda belum aktif. Harap verifikasi terlebih dahulu');
            }
        } else {
            return redirect()->route('auth')->withErrors('Email atau Password salah');
        }
    }
    function create()
    {
        return view('halaman_auth/register');
    }
    function register(Request $request)
    {
        $str = Str::random(100);
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'role' => 'required|in:pemilikkos,user', // Menambahkan validasi role
            'gambar' => 'required|image|file',
        ], [
            'fullname.required' => 'Full Name wajib diisi',
            'fullname.min' => 'Full Name minimal 5 karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email tidak terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role tidak valid',
            'gambar.required' => 'Gambar wajib di upload',
            'gambar.image' => 'Gambar yang di upload harus image',
            'gambar.file' => 'Gambar harus berupa file',
        ]);

        //penamaan gambar diambil dari waktu user login
        $gambar_file = $request->file('gambar');
        $gambar_ekstensi = $gambar_file->extension();
        $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
        $gambar_file->move(public_path('picture/accounts'), $nama_gambar);

        //ROLE BISA DIMASUKKAN KE SINI di authcontroller.php jika defaultnya bukan user
        $inforegister = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'gambar' => $nama_gambar,
            'verify_key' => $str
        ];

        // $users = new User();
        // $users->id = Uuid::uuid4()->toString();
        // $users->fullname = $request->fullname;
        // $users->email = $request->email;
        // $users->password = $request->password;
        // $users->role = $request->role;
        // $users->gambar = $request->nama_gambar;
        // $users->verify_key = $request->nama_kategori;
        // $users->save();

        //untuk mengirim autentifikasi ke email
        User::create($inforegister);
        $details = [
            'fullname' => $inforegister['fullname'],
            'role' => 'pemilikkos', 'user',
            'datetime' => date('Y-m-d H:i:s'),
            'website' => 'KosConnect',
            'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $inforegister['verify_key'],
        ];

            Mail::to($inforegister['email'])->send(new AuthMail($details));

            return redirect()->route('auth')->with('success','Link Verifikasi telah dikirim ke email Anda. Cek email untuk melakukan verifikasi');
    }
    function verify($verify_key){
        $keyCheck = User::select('verify_key')
        ->where('verify_key',$verify_key)
        ->exists();

        if($keyCheck){
            $user = User::where('verify_key',$verify_key)->update(['email_verified_at' => date('Y-m-d H:i:s')]);

            return redirect()->route('auth')->with('success','Verifikasi berhasil. Akun Anda sudah aktif');
        } else{
            return redirect()->route('auth')->withErrors('Key tidak valid. Pastikan telah melakukan Sign Up')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
