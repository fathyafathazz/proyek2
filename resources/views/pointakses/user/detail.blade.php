@extends('layout.index')
@section('title', 'Detail Kamar')
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

        /* Atur tata letak carousel */
        #gambar-carousel {
            width: 100%;
            margin-bottom: 20px;
        }

        .carousel-inner {
            height: 100%;
            /* Set tinggi sesuai kebutuhan */
        }

        .carousel-item {
            text-align: center;
            /* Agar gambar berada di tengah-tengah */
        }

        .carousel-item img {
            max-height: 100%;
            /* Agar gambar tidak melebihi tinggi carousel */
            margin: auto;
            /* Agar gambar berada di tengah-tengah */
        }
    </style>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="/home" style="color: #15967d">Kos</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $kamar->kos->nama_kos }} / {{ $kamar->nomor_kamar }}</strong><span
                        class="mx-2 mb-0">/</span>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="gambar-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($kamar->gambarKamar as $key => $gambar)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('public/kamar_kos/' . $gambar->gambar) }}"
                                        alt="{{ $gambar->gambar }}" class="d-block w-100">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#gambar-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#gambar-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $kamar->nomor_kamar }}, {{ $kamar->kos->nama_kos }}</h2>
                    <p>
                        {{ $kamar->kos->alamat_kos }}
                    </p>
                    <p style="font-size: 16px; font-weight:600;">
                        Kategori: {{ $kamar->kos->kategori }}

                        </a>
                    </p>
                    <p><strong>Keterangan Kamar : </strong>{{ $kamar->keterangan_kamar }}</p>
                    <p><strong>Ukuran Kamar : </strong>{{ $kamar->ukuran_kamar }}</p>
                    <p><strong>Fasilitas Kamar : </strong>{{ $kamar->fasilitas_kamar }}</p>
                    <p><strong>Deskripsi Kos : </strong>{{ $kamar->kos->keterangan_kos }}</p>
                    <p><strong>Fasilitas Kos : </strong>{{ $kamar->kos->fasilitas }}</p>
                    <p><strong>Fasilitas Kamar : </strong>{{ $kamar->fasilitas_kamar }}</p>
                    <p><strong>Custom Fasilitas : </strong>
                        @if (count($kamar->fasilitasCustom) > 0)
                            @foreach ($kamar->fasilitasCustom as $fasilitas)
                                <input type="checkbox" disabled checked> {{ $fasilitas->nama }}<br>
                            @endforeach
                        @else
                            Tidak ada custom fasilitas
                        @endif
                    </p>
                    <p style=" color: #1abc9c;"><strong class="h4">Rp {{ number_format($kamar->harga_sewa) }}
                        </strong></p>
                    <div class="mb-5">
                        <form action="{{ route('pemesanan.index', ['id' => $kamar->id]) }}" method="GET"
                            enctype="multipart/form-data">
                            @csrf
                            @if (Route::has('login'))
                                @auth
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @endauth
                            @endif
                            <input type="hidden" name="id_kamar_kos" value="{{ $kamar->id }}">
                            <strong><small>Jumlah Kamar Tersedia {{ $kamar->jumlah_kamar_tersedia }}</small></strong>
                            <input type="hidden" value="{{ $kamar->jumlah_kamar_tersedia }}" id="sisakamar">
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
