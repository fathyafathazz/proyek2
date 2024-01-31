@extends('halaman_dashboard.index')
@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @if (Auth::user()->role == 'admin')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span {{ route('admin') }}>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Manajemen Transaksi</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Transaksi:</h6>
                    <a class="collapse-item" href="{{ route('transaksi') }}">Transaksi</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Manajemen Pengguna</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Pengguna:</h6>
                    <a class="collapse-item" href="{{ route('usercontrol') }}">Kontrol Pengguna</a>
                </div>
            </div>
        </li>
    @endif
    @if (Auth::user()->role == 'pemilikkos')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/pemilikkos">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span {{ route('pemilikkos') }}>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Manajemen Kos</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Kos:</h6>
                    <a class="collapse-item" href="{{ route('kos') }}">Kos</a>
                    <a class="collapse-item" href="{{ route('kamar_kos') }}">Kamar Kos</a>
                    <a class="collapse-item" href="{{ route('fasilitas_custom') }}">Fasilitas Custom</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Kelola Pesanan</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Pesanan:</h6>
                    <a class="collapse-item" href="/transaksi">Pesanan</a>
                </div>
            </div>
        </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
@endsection
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
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-bottom: 35px;">
            @if (Auth::user()->role != 'admin')
                <div class="col-12 mt-3 mb-3">
                    <a href="{{ url()->previous() }}" class="btn" style="background-color: #1abc9c; color: white;">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali</a>
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
                                <img src="{{ asset('halaman_depan/assets/img/logokos.png') }}" alt=""
                                    class="w-45" style="height: 45px;">
                            </div>
                            <div class="title-text h5 ml-1" style="color: #1abc9c;"><strong>KosConnect</strong></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="font-weight-bold h4 text-center" style="margin-bottom: 0">
                        {{ $pemesanan->kamarKos->kos->nama_kos }} </div>
                    <div class="font-weight-bold h4 text-center" style="margin-bottom: 0">
                        {{ $pemesanan->kamarKos->kos->alamat_kos }} </div>
                    <div class="font-weight-bold h4 text-center" style="margin-bottom: 0">
                        {{ $pemesanan->kamarKos->nomor_kamar }}, Kos {{ $pemesanan->kamarKos->kos->kategori }}, Ukuran
                        Kamar
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
                            <td style="text-align: right;">{{ $pemesanan->nama_pemesan }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td style="text-align: right;">{{ $pemesanan->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Alamat Pemesan</td>
                            <td style="text-align: right;">{{ $pemesanan->alamat_pemesan }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td style="text-align: right;">{{ $pemesanan->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <td>Fasilitas Custom yang Dipilih</td>
                            <td style="text-align: right;">
                                @if ($pemesanan->selected_fasilitas_custom && count($pemesanan->selected_fasilitas_custom) > 0)
                                    @foreach ($pemesanan->selected_fasilitas_custom as $fasilitasId)
                                        @php
                                            $fasilitas = \App\Models\FasilitasCustom::find($fasilitasId);
                                        @endphp
                                        @if ($fasilitas)
                                            {{ $fasilitas->nama }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    Tidak Ada Fasilitas yang Dipilih.
                                @endif
                            </td>
                        </tr>

                        <td>Total Pesanan</td>
                        <td style="text-align: right;">
                            Rp.
                            {{ number_format($pemesanan->total_pemesanan, 0, ',', '.') }}
                        </td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td style="text-align: right;">{{ $pemesanan->status }}</td>
                        </tr>
                        @if ($pemesanan->status == 'Sudah Bayar')
                            <tr>
                                <td>Di Verifikasi oleh</td>
                                <td style="text-align: right;">
                                    {{ $pemesanan->verified_by ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Verifikasi</td>
                                <td style="text-align: right;">
                                    {{ $pemesanan->tanggal_verifikasi->format('l, d F Y H:i:s') ?? '-' }}
                                    {{-- {{ optional($pemesanan->tanggal_verifikasi)->format('d-m-Y H:i:s') ?? '-' }} --}}
                                </td>
                            </tr>
                        @endif

                    </table>
                </div>
                @if ($pemesanan->status == 'Belum Bayar' && Auth::user()->role == 'admin')
                    <div class="card-body">
                        <a href="{{ route('pembayaran', $pemesanan->id) }}"
                            class="btn btn-primary btn-block btn-sm text-white">Verifikasi</a>

                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white" id="footer">
        <div class="container my-auto">
            <div class="text-center">
                <span>Copyright &copy; KosConnect 2023</span>
            </div>
        </div>
    </footer>
    </div>
@endsection
