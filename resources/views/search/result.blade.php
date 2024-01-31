@extends('layout.index')
@section('title', 'Hasil Pencarian')
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

        .card a {
            color: #314051;
            text-decoration: none;
        }


        .card {
            margin-bottom: 20px;
        }


        .container {
            margin-top: 20px;
        }


        body {
            margin-bottom: 60px;
        }
    </style>

    <h4 class="mt-5">Hasil Pencarian</h4>
    <div class="content mt-3 d-flex flex-lg-wrap gap-5 mb-5">
        @forelse ($result as $kamarKos)
            <div class="card" style="width:320px;">

                <div class="card-header m-auto" style="height:100%;width:100%;">
                    <a href="{{ route('user.detail', ['id' => $kamarKos->id]) }}">
                        @if($kamarKos->gambarKamar->isNotEmpty())
                            <img src="{{ asset('public/kamar_kos/' . $kamarKos->gambarKamar->first()->gambar) }}" alt="kamar kos"
                                style="width: 100%; height:200px; object-fit: cover; padding:0;">
                        @else
                            <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image"
                                style="width: 100%; height:200px; object-fit: cover; padding:0;">
                        @endif
                    </a>
                </div>
                <div class="card-body">
                    <p class="m-0 text-justify" style="font-size: 16px; font-weight:600;"><a
                            href="{{ route('user.detail', ['id' => $kamarKos->kos->id]) }}" style="color: #359690">
                            Kategori:
                            @if ($kamarKos->kos->kategori == 'Putra')
                                Kos Putra
                            @elseif($kamarKos->kos->kategori == 'Putri')
                                Kos Putri
                            @elseif($kamarKos->kos->kategori == 'Campur')
                                Kos Campur
                            @else
                                {{ $kamarKos->kos->kategori }}
                            @endif
                        </a></p>
                    <p class="m-0 text-justify" style="font-size: 16px; font-weight:600;"><a
                            href="{{ route('user.detail', ['id' => $kamarKos->id]) }}">{{ $kamarKos->nomor_kamar }},
                            {{ $kamarKos->kos->nama_kos }} </a></p>
                    {{-- <p class="m-0 text-justify" style="font-size: 16px; font-weight:600;">{{ $kos->kos->nama_kos }}</p> --}}
                    <p class="m-0 text-justify"><a href="{{ route('user.detail', ['id' => $kamarKos->id]) }}">Alamat
                            Kos: {{ $kamarKos->kos->alamat_kos }} </a></p>
                </div>

                <div class="card-footer d-flex flex-row justify-content-between align-items-center">
                    <p class="m-0" style="font-size: 16px; font-weight:600; color:#314051 "><span>Rp

                        </span><a
                            href="{{ route('user.detail', ['id' => $kamarKos->kos->id]) }}">{{ number_format($kamarKos->harga_sewa) }}
                        </a></p>
                    <form action="{{ route('pemesanan.index', ['id' => $kamarKos->id]) }}" method="GET"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_kamar_kos" value="{{ $kamarKos->id }}">
                        <button type="submit" class="btn btn-outline-primary" style="font-size: 14px;">Booking</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Tidak ada hasil yang ditemukan.</p>
            </div>
        @endforelse
    </div>
@endsection
