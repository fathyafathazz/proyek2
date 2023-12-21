@extends('halaman_dashboard.index')
@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manajemen Kos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Kos:</h6>
                <a class="collapse-item" href="{{ route('kategori') }}">Kategori</a>
                <a class="collapse-item" href="{{ route('jenis_kos') }}">Jenis Kos</a>
                <a class="collapse-item" href="{{ route('fasilitas') }}">Fasilitas Kos</a>
                <a class="collapse-item" href="{{ route('fasilitas_kamar') }}">Fasilitas Kamar</a>
                <a class="collapse-item" href="{{ route('kos') }}">Kos</a>
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
                <form class="forms-sample" method="POST" action="/tambahkos" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<uuid-value>"
                            disabled>
                    </div>

                    <div class="form-group">
                        <label for="nama_kos">Nama Kos</label>
                        <input type="text" class="form-control" id="nama_kos" placeholder="Kos Pelangi"
                            name="nama_kos" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kos">Alamat Kos</label>
                        <input type="text" class="form-control" id="alamat_kos"
                            placeholder="Jl. Sari Asih No.54, Sarijadi, Kec. Sukasari, Kota Bandung, Jawa Barat"
                            name="alamat_kos" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kos">Deskripsi Kos</label>
                        <input type="text" class="form-control" id="deskripsi_kos"
                            placeholder="Lokasi strategis, fasilitas lengkap" name="deskripsi_kos" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategoris">Kategori</label>
                        @if($kategoris != $old_kategoris)
                        <select class="select2 form-control" id="id_kategoris" name="id_kategoris" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategoris)
                                <option value="{{ $kategoris->id }}">{{ $kategoris->nama_kategori }}</option>
                            @endforeach
                        </select>@endif
                    </div>
                    <div class="form-group">
                        @if($jeniskos != $old_jeniskos)
                        <label for="id_jenis_kos">Jenis Kos:</label>
                        <select class="select2 form-control" id="id_jenis_kos" name="id_jenis_kos" required>
                            <option value="" disabled selected>-- Pilih Jenis Kos --</option>
                            @foreach ($jeniskos as $jeniskos)
                                <option value="{{ $jeniskos->id }}">{{ $jeniskos->nama_jenis_kos }}</option>
                            @endforeach
                        </select>@endif
                    </div>
                    {{-- <div class="input-group mb-3">
                        <label for="fasilitas">Fasilitas Kos</label>
                        <select class="select2 form-control" id="id_fasilitas" name="fasilitas[]" multiple required aria-describedby="button-addon2">
                            <option value="" disabled selected>-- Pilih Fasilitas Kos --</option>
                            @foreach ($fasilitas as $fasilitas)
                                <option value="{{ $fasilitas->id }}">{{ $fasilitas->nama_fasilitas }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" onclick="submitFasilitas()">Simpan Fasilitas</button>
                    </div>
                    <div id="fasilitas-terpilih">
                    </div> --}}

                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="/kos" class="btn btn-light">Kembali</a>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
{{-- <script>
    $(document).ready(function() {
        // Initialize Select2 for fasilitas dropdown
        $('#id_fasilitas').select2();

        // Function to submit only fasilitas
        function submitFasilitas() {
            const fasilitasForm = $('#id_fasilitas').closest('form');
            const fasilitasData = new FormData(fasilitasForm[0]);
            fasilitasData.delete('_token'); // Remove CSRF token

            $.ajax({
                url: '/simpan-fasilitas', // Adjust the URL if needed
                type: 'POST',
                data: fasilitasData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#fasilitas-terpilih').html(response); // Display selected fasilitas
                },
                error: function(error) {
                    // Handle errors here
                }
            });
        }
    });
</script> --}}
@endsection
