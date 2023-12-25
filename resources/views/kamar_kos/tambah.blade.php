@extends('halaman_dashboard.index')
@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
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
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="{{ route('datamahasiswa') }}">Data Mahasiswa</a>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
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
                <h4 class="card-title mb-4">Tambah data Kos</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/tambahkamarkos" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_kos">Nama Kos</label>
                        <select class="select2 form-control" id="id_kos" name="id_kos" required>
                            <option value="" disabled selected>-- Pilih Kos --</option>
                            @foreach ($kos as $kos)
                                <option value="{{ $kos->id }}">{{ $kos->nama_kos }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_kamar">Nomor Kamar</label>
                        <input type="text" class="form-control" id="nomor_kamar" placeholder="Tipe A/No. 1 dsb"
                            name="nomor_kamar" required>
                    </div>

                    <div class="form-group">
                        <label for="ukuran_kamar">Ukuran Kamar</label>
                        <input type="text" class="form-control" id="ukuran_kamar"
                            placeholder="4 x 3 meter"
                            name="ukuran_kamar" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_kamar">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_kamar" placeholder="tidak beserta listrik"
                            name="keterangan_kamar" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_sewa">Harga Sewa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" required>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="fasilitas_kamar">Fasilitas Kamar</label>
                        <input type="text" class="form-control" id="fasilitas_kamar" placeholder="Single Bed, Lemari dsb"
                            name="fasilitas_kamar" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kamar_tersedia">Jumlah Kamar Tersedia</label>
                        <input type="number" class="form-control" id="jumlah_kamar_tersedia"
                            placeholder="12"
                            name="jumlah_kamar_tersedia" required>
                    </div>                    
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="/kamar_kos" class="btn btn-light">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    document.getElementById('harga_sewa').addEventListener('input', function (e) {
        // Hapus semua karakter non-digit
        let value = e.target.value.replace(/\D/g, '');

        // Format angka dengan tanda pemisah ribuan
        value = new Intl.NumberFormat('id-ID').format(value);

        // Tampilkan hasil format ke input
        e.target.value = value;
    });
</script>

@endsection
