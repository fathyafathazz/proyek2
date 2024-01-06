@extends('halaman_dashboard.index')
@section('navitem')
 <!-- Divider -->
 <hr class="sidebar-divider my-0">

 <!-- Nav Item - Dashboard -->
 <li class="nav-item active">
     <a class="nav-link" href="/admin">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span {{route('admin')}}>Dashboard</span></a>
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
             <a class="collapse-item" href="">Konfirmasi Pembayaran</a>
             {{-- <a class="collapse-item" href="{{route('kategori')}}">Kategori</a>
             <a class="collapse-item" href="{{route('jenis_kos')}}">Jenis Kos</a> --}}
     </div>
 </li>

 <!-- Nav Item - Utilities Collapse Menu -->
 <li class="nav-item">
     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
         aria-expanded="true" aria-controls="collapseUtilities">
         <i class="fas fa-fw fa-wrench"></i>
         <span>Manajemen Pengguna</span>
     </a>
     <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
         data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
             <h6 class="collapse-header">Manajemen Pengguna:</h6>
             <a class="collapse-item" href="{{route('usercontrol')}}">Kontrol Pengguna</a>
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
             <a class="collapse-item" href="{{route('datamahasiswa')}} ">Data Mahasiswa</a>
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
    <!-- Begin Page Content  isi tengahnya dashboard--> 
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" >{{ Auth::user()->email }}
                                     </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" {{ Auth::user()->role }}>
                                    Admin</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection