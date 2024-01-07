@extends('halaman_dashboard.index')
@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span {{route('pemilikkos')}}>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manajemen Kos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Kos:</h6>
                <a class="collapse-item" href="{{ route('kos') }}">Kos</a>
                <a class="collapse-item" href="{{ route('kamar_kos') }}">Kamar Kos</a>
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

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
@endsection
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit data Kos</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form class="forms-sample" method="POST" action="/editkos">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="nama_kos">Nama Kos</label>
                            <input type="text" class="form-control" id="nama_kos" name="nama_kos"
                                value="{{ $data->nama_kos }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_kos">Alamat Kos</label>
                            <input type="text" class="form-control" id="alamat_kos" name="alamat_kos"
                                value="{{ $data->alamat_kos }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_kos">Keterangan Kos</label>
                            <input type="text" class="form-control" id="keterangan_kos" name="keterangan_kos"
                                value="{{ $data->keterangan_kos }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fasilitas">Fasilitas</label>
                            <input type="text" class="form-control" id="fasilitas" name="fasilitas"
                                value="{{ $data->fasilitas }}" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori Kos</label>
                            <select class="select2 form-control" id="kategori" name="kategori" required>
                                <option value="{{ $data->kategori }}" disabled selected>{{ $data->kategori }}</option>
                                <option value="Campur">Kos Campur</option>
                                <option value="Putra">Kos Putra</option>
                                <option value="Putri">Kos Putri</option>
                            </select>
                        </div>   
                        {{-- <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori"
                                 required>
                        </div> --}}
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
                        <a href="/kos" class="btn btn-light">Kembali</a>
                    </form>
            </div>
        </div>
    </div>
@endsection
