@extends('layout.index')
@section('title',"Detail Kamar")
@section('content')
    <style>
        .btn-outline-primary {
            --bs-btn-color: #1abc9c;
            --bs-btn-border-color: #1abc9c;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #1abc9c;
            --bs-btn-hover-border-color: #1abc9c;
            --bs-btn-focus-shadow-rgb: 26, 188, 156;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #1abc9c;
            --bs-btn-active-border-color: #1abc9c;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #1abc9c;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #1abc9c;
            --bs-gradient: none;
        }

        .btn-primary {
            --bs-btn-color: #1abc9c;
            --bs-btn-border-color: #1abc9c;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #15967d;
            --bs-btn-hover-border-color: #15967d;
            --bs-btn-focus-shadow-rgb: 26, 188, 156;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #1abc9c;
            --bs-btn-active-border-color: #1abc9c;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #1abc9c;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #1abc9c;
            --bs-gradient: none;
            outline-width: 3pt;
        }

        /* Atur tata letak tombol booking sejajar dengan input-group */
        .input-group .btn-outline-primary,
        .input-group .btn-primary {
            margin-top: 0;
        }
    </style>
        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="/home" style="color: #15967d">Kos</a> <span class="mx-2 mb-0">/</span> <strong
                            class="text-black">{{ $data->kos->nama_kos }} / {{ $data->nomor_kamar }}</strong><span
                            class="mx-2 mb-0">/</span></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('public/kamar_kos/' . $data->gambar) }}" alt="kamar kos" class="img-fluid"></a>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-black">{{ $data->nomor_kamar }}, {{ $data->kos->nama_kos }}</h2>
                        <p>
                            {{ $data->kos->alamat_kos }}
                        </p>
                        <p style="font-size: 16px; font-weight:600;">
                            Kategori:
                            @if ($data->kos->kategori == 'Putra')
                                Kos Putra
                            @elseif($data->kos->kategori == 'Putri')
                                Kos Putri
                            @elseif($data->kos->kategori == 'Campur')
                                Kos Campur
                            @else
                                {{ $data->kos->kategori }}
                            @endif
                            </a>
                        </p>
                        <p><strong>Keterangan Kamar : </strong>{{ $data->keterangan_kamar }}</p>
                        <p><strong>Ukuran Kamar : </strong>{{ $data->ukuran_kamar }}</p>
                        <p><strong>Fasilitas Kamar : </strong>{{ $data->fasilitas_kamar }}</p>
                        <p><strong>Deskripsi Kos : </strong>{{ $data->kos->keterangan_kos }}</p>
                        <p><strong>Fasilitas Kos : </strong>{{ $data->kos->fasilitas }}</p>
                        <p style=" color: #1abc9c;"><strong class="h4">Rp {{ number_format($data->harga_sewa) }}
                            </strong></p>
                        <div class="mb-5">
                            {{-- {{ route('user.keranjang.simpan') }} --}}
                            <form action="{{route('pemesanan.index', ['id' => $data->id])}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                @if (Route::has('login'))
                                    @auth
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @endauth
                                @endif
                                <input type="hidden" name="id_kamar_kos" value="{{ $data->id }}">
                                <strong><small>Jumlah Kamar Tersedia {{ $data->jumlah_kamar_tersedia }}</small></strong>
                                <input type="hidden" value="{{ $data->jumlah_kamar_tersedia }}" id="sisakamar">
                                {{-- <div class="input-group mb-3" style="max-width: 120px;">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                    <input type="text" name="jumlah_kamar_tersedia" class="form-control text-center"
                                        value="1" placeholder="" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>                                 --}}
                                <input type="submit" class="buy-now btn btn-primary"
                                    style="font-size: 14px; background-color: #1CBB9C; color: #fff; transition: background-color 0.3s ease;"
                                    value="Pesan Sekarang">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputJumlahKamar = document.querySelector('input[name="jumlah_kamar_tersedia"]');
            const btnPlus = document.querySelector('.js-btn-plus');
            const btnMinus = document.querySelector('.js-btn-minus');
    
            btnPlus.addEventListener('click', function() {
                inputJumlahKamar.value = parseInt(inputJumlahKamar.value) + 1;
            });
    
            btnMinus.addEventListener('click', function() {
                if (parseInt(inputJumlahKamar.value) > 1) {
                    inputJumlahKamar.value = parseInt(inputJumlahKamar.value) - 1;
                }
            });
        });
    </script>
    
@endsection
