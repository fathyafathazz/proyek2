 @extends('halaman_dashboard.index')
 @section('navitem')
     <!-- Divider -->
     <hr class="sidebar-divider my-0">

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
                 <a class="collapse-item" href="{{ route('datamahasiswa') }} ">Data Mahasiswa</a>
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
     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Data Kategori Kos</h1>
         <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
             For more information about DataTables, please visit the <a target="_blank"
                 href="https://datatables.net">official DataTables documentation</a>.</p>

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 {{-- <h6 class="m-0 font-weight-bold text-primary mb-4">DataTables Example</h6> --}}
                 {{-- new --}}

                 <a href="/kategoritambah" class="btn-sm btn-primary text-decoration-none">Tambah data</a>

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
                                 <th>ID</th>
                                 <th>Nama Kategori</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tfoot>
                             <tr>
                                 <th>ID</th>
                                 <th>Nama Kategori</th>
                                 <th>Action</th>
                             </tr>
                         </tfoot>
                         <tbody>
                             @foreach ($data as $item)
                                 <tr>
                                     <td>{{ $item->id }}</td>
                                     <td>{{ $item->nama_kategori }}</td>
                                     <td><a href="/kategoriedit/{{ $item->id }}"
                                             class="btn-sm btn-warning text-decoration-none">Edit</a> |
                                         <form onsubmit="return confirmHapus(event)"
                                             action="/kategorihapus/{{ $item->id }}" method="post"
                                             class="d-inline">
                                             @csrf
                                             <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                         </form>
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
 {{-- ini buat swall --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>
     function confirmHapus(event) {
         event.preventDefault(); // Menghentikan form dari pengiriman langsung

         Swal.fire({
             title: 'Yakin Hapus Data?',
             text: "Data yang dihapus tidak dapat dikembalikan!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Hapus',
             cancelButtonText: 'Batal'
         }).then((willDelete) => {
             if (willDelete.isConfirmed) {
                 event.target.submit(); // Melanjutkan pengiriman form
             } else {
                 swal('Your imaginary file is safe!');
             }
         });
     }
 </script>
