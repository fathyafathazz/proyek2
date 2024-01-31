@extends('halaman_dashboard.index')

@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pemilikkos') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
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
                <h4 class="card-title mb-4">Tambah Gambar Kamar Kos</h4>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <!-- Form Input Gambar -->
                    <form action="{{ route('kamar_kos.store.gambar', ['id' => $kamar->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Kamar:</label>
                            <input type="file" name="gambar[]" accept="image/*" class="form-control" multiple required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Unggah Gambar</button>
                            <a href="{{ route('kamar_kos') }}" class="btn btn-light">Kembali</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Limit the number of images to 10
        $('#gambar').change(function() {
            if (this.files.length > 10) {
                alert('Maksimal 10 gambar yang dapat diupload.');
                this.value = '';
            }
        });
    </script>
@endsection
