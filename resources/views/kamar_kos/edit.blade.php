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
                <h4 class="card-title mb-4">Edit data Kamar Kos</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form class="forms-sample" method="POST" action="/editkamarkos" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="id_kos">Nama Kos</label>
                            <select class="select2 form-control" id="id_kos" name="id_kos" required>
                                <option value="{{ $data->nama_kos }}" selected>{{ $data->nama_kos }}</option>
                                @foreach ($kos as $kos)
                                    <option value="{{$kos->id}}">{{ $kos->nama_kos }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomor_kamar">Nomor Kamar</label>
                            <input type="text" class="form-control" id="nomor_kamar" name="nomor_kamar"
                                value="{{ $data->nomor_kamar }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ukuran_kamar">Ukuran Kamar</label>
                            <input type="text" class="form-control" id="ukuran_kamar" name="ukuran_kamar"
                                value="{{ $data->ukuran_kamar }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_kamar">Keterangan Kos</label>
                            <input type="text" class="form-control" id="keterangan_kamar" name="keterangan_kamar"
                                value="{{ $data->keterangan_kamar }}" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_sewa">Harga Sewa</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" value="{{ $data->harga_sewa }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fasilitas_kamar">Fasilitas Kamar</label>
                            <input type="text" class="form-control" id="fasilitas_kamar" name="fasilitas_kamar"
                                value="{{ $data->fasilitas_kamar }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_kamar_tersedia">Jumlah Kamar Tersedia</label>
                            <input type="number" class="form-control" id="jumlah_kamar_tersedia" name="jumlah_kamar_tersedia"
                                value="{{ $data->jumlah_kamar_tersedia }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <div class="p-2">
                                <img src="{{ asset('public/kamar_kos') }}/{{ $data->gambar }}" alt="Image"
                                style="width: 50px; height: 50px;"  >
                            </div>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
                        <a href="/kamar_kos" class="btn btn-light">Kembali</a>
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
