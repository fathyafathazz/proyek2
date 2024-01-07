
@extends('layout.index')
@section('title', 'Detail Pesanan')
@if (Auth::user()->role == 'admin')
    @section('heading', 'Detail Pesanan')
@endif
@section('styles')
    <style>
        body,
        .card-body,
        .title-text {
            font-family: 'Montserrat', sans-serif !important;
        }

        .card-body {
            padding: .5rem 1rem;
            color: #000;
            border-bottom: 1px solid #e3e6f0;
            font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
                "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        .card {
            margin-bottom: 35px;
            font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
                "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }


        .title {
            color: #1abc9c;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            z-index: 1;
            align-items: center;
            justify-content: center;
            display: flex;
        }

        .title .title-text {
            display: inline;
            color: #1abc9c;
            /* Warna untuk "KosConnect" */
        }

        .table {
            margin-bottom: 0;
            color: #000;
        }

        .table td {
            padding: 0;
            border-top: none;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center" style="margin-bottom: 35px;">
        @if (Auth::user()->role != 'admin')
            <div class="col-12 mt-3 mb-3">
                <a href="{{ url()->previous() }}" class="btn" style="background-color: #1abc9c; color: white;"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        @else
            <div class="col-12">
        @endif
        <div class="card shadow h-100" style="border-top: .25rem solid #1abc9c; border-bottom: .25rem solid #1abc9c ">
            <div class="card-body">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col h5 font-weight-bold" style="margin-bottom: 0">Detail Pemesanan</div>
                    <div class="col-auto d-flex align-items-center">
                        <div class="title-icon">
                            <img src="{{ asset('halaman_depan/assets/img/logokos.png') }}" alt="" class="w-45" style="height: 45px;">
                        </div>
                        <div class="title-text h5 ml-1" style="color: #1abc9c;"><strong>KosConnect</strong></div>
                    </div>                    
                </div>
            </div>
            <div class="card-body">
                {{-- {{ $data->rute->tujuan }} --}}
                <div class="font-weight-bold h4 text-center" style="margin-bottom: 0">
                    {{ $pemesanan->kamarKos->kos->nama_kos }} </div>
                <div class="font-weight-bold h4 text-center" style="margin-bottom: 0">
                    {{ $pemesanan->kamarKos->kos->alamat_kos }} </div>
                <div class="font-weight-bold h4 text-center" style="margin-bottom: 0">
                    {{ $pemesanan->kamarKos->nomor_kamar }}, Kos {{ $pemesanan->kamarKos->kos->kategori }}, Ukuran Kamar
                    {{ $pemesanan->kamarKos->ukuran_kamar }} </div>
                <div class="row no-gutters align-items-center justify-content-center">

                    <div class="col px-3">
                        <div style="border-top: 1px solid black"></div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col">
                        <p style="margin-bottom: 0">Kode Booking</p>
                        <h3 class="font-weight-bold">{{ $pemesanan->kode_pemesanan }}</h3>
                    </div>
                    <div class="col-auto">
                        {!! DNS1D::getBarcodeHTML($pemesanan->kode_pemesanan, 'C128', 1.2, 45) !!}
                    </div>
                </div>
                <p style="margin-bottom: 0; margin-top: 5px;">Tanggal Pemesanan</p>
                <h5 class="font-weight-bold text-center">
                    <div>
                        {{ $pemesanan->tanggal_pemesanan->format('l, d F Y H:i:s') }} WIB
                    </div>
                </h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Nama Pemesan</td>
                        <td class="text-right">{{ $pemesanan->nama_pemesan }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Pemesan</td>
                        <td class="text-right">{{ $pemesanan->alamat_pemesan }}</td>
                    </tr>
                    <tr>
                        <td>Total Pesanan</td>
                        <td class="text-right">Rp. {{ number_format($pemesanan->total_pemesanan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Status Pembayaran</td>
                        <td class="text-right">{{ $pemesanan->status }}</td>
                    </tr>
                    @if ($pemesanan->status == 'Sudah Bayar')
                    <tr>
                        <td>Di Verifikasi oleh</td>
                        <td class="text-right">
                            {{ $pemesanan->verified_by ?? '-' }} </td>
                    </tr>
                @endif
                </table>
            </div>
            @if ($pemesanan->status == 'Belum Bayar' && Auth::user()->role == 'admin')
                <div class="card-body">
                    <a href="{{ route('pembayaran', $pemesanan->id) }}" class="btn btn-block btn-sm text-white" style="background-color: #1abc9c; color: white;">Verifikasi</a>
                    
                </div>
            @endif
           
        </div>
    </div>
    </div>
    </div>
@endsection