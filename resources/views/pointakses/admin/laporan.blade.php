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
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        @if (Auth::user()->role == 'admin')
            <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
        @else
            <h1 class="h3 mb-2 text-gray-800">Data Pesanan</h1>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire(
                                'Sukses',
                                '{{ Session::get('success') }}',
                                'success'
                            );
                        });
                    </script>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pemesan</th>
                                <th>Pemesan</th>
                                <th>Nama Kos</th>
                                <th>Nomor Kamar</th>
                                <th>Total Pemesanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Pemesan</th>
                                <th>Pemesan</th>
                                <th>Nama Kos</th>
                                <th>Nomor Kamar</th>
                                <th>Total Pemesanan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($pemesanan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <h5 class="card-title">{!! DNS1D::getBarcodeHTML($data->kode_pemesanan, 'C128', 2, 30) !!}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $data->kode_pemesanan }}
                                            </small>
                                        </p>
                                    </td>
                                    <td>
                                        <h5 class="card-title">{{ $data->nama_pemesan }}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $data->alamat_pemesan }} - {{ $data->nomor_telepon }}
                                            </small>
                                        </p>
                                    </td>
                                    <td>
                                        <h5 class="card-title">{{ $data->kamarKos->kos->nama_kos }}</h5>
                                        <p class="card-text">
                                            @if (Auth::user()->role == 'admin')
                                            <small class="text-muted">
                                                 {{ $data->kamarKos->kos->kategori }} - Milik
                                                {{ $data->kamarKos->kos->pemilikkos->fullname }}
                                            </small>
                                        @else
                                        <small class="text-muted">
                                         {{ $data->kamarKos->kos->kategori }}
                                        </small>
                                        @endif
                                
                                            
                                        </p>
                                    </td>
                                    <td>
                                        <h5 class="card-title">{{ $data->kamarKos->nomor_kamar }}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Harga Sewa : Rp. {{ number_format($data->kamarKos->harga_sewa) }} - Jumlah
                                                : {{ $data->jumlah_kamar }}
                                            </small>
                                        </p>
                                    </td>
                                    <td>
                                        <h5 class="card-title">Rp. {{ number_format($data->total_pemesanan, 0, ',', '.') }}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ date('l, d F Y H:i', strtotime($data->tanggal_pemesanan)) ?? 'Nomor Kamar Tidak Tersedia' }}
                                                WIB
                                            </small>
                                        </p>
                                    </td>

                                    <td>
                                        <a href="{{ route('transaksi.show', $data->kode_pemesanan) }}"
                                            class="btn btn-info btn-circle"><i class="fas fa-search-plus"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
