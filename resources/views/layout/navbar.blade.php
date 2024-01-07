<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>KosConnect</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('halaman_depan/assets/img/logokos.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    {{-- <link href="{{ view('layout/styles.css') }}" rel="stylesheet" /> --}}
</head>

<body id="page-top">

    <body id="page-top">
        <!-- Navigation-->
        <style>
            #mainNav {
                font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
                    "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 700;
            }

            #mainNav .navbar-brand {
                color: #fff;
            }

            #mainNav .navbar-nav {
                margin-top: 1rem;
            }

            #mainNav .navbar-nav li.nav-item {
                margin: 0;
            }

            #mainNav .navbar-nav li.nav-item a.nav-link {
                color: #fff;
                display: flex;
                align-items: center;
            }

            #mainNav .navbar-nav li.nav-item a.nav-link:hover {
                color: #1abc9c;
            }

            #mainNav .navbar-nav li.nav-item a.nav-link:active,
            #mainNav .navbar-nav li.nav-item a.nav-link:focus {
                color: #fff;
            }

            #mainNav .navbar-nav li.nav-item a.nav-link.active {
                color: #1abc9c;
            }

            #mainNav .navbar-nav li.nav-item a.nav-link .img-profile {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                margin-right: 10px;
            }

            #mainNav .navbar-toggler {

                font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
                    "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 500;
                /* font-size: 80%; */
                --bs-btn-color: #1abc9c;
                padding: 1%;
                padding-bottom: 2%;
                padding-top: 2%;
            }

            .btn:hover {
                background-color: #1abc9c;
            }
        </style>

        <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #314051" id="mainNav">
            <div class="container">

                <a class="navbar-brand" href="/home"><img src="{{ asset('halaman_depan/assets/img/logokos.png') }}"
                        width="50" height="50">KosConnect</a>
                <button class="navbar-toggler text-uppercase font-weight-bold btn-primary text-white rounded"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                    style="background-color: #1abc9c">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto justify-content-between">
                        <form class="d-flex mx-0 mx-lg-1 py-2 px-0 px-lg-2 rounded" action="{{ route('search') }}"
                            method="GET" style="height: 50px;">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                name="query">
                            <select class="form-select me-2" name="kategori" style="width: auto; min-width: 150px;">
                                <option value="">Semua Kategori</option>
                                <option value="Putra">Kos Putra</option>
                                <option value="Putri">Kos Putri</option>
                                <option value="Campur">Kos Campur</option>
                            </select>
                            <button class="btn"
                                style="border: 2px solid #1abc9c; color: white; vertical-align: center;"
                                type="submit">Cari</button>
                        </form>

                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-2 px-0 px-lg-2 rounded"
                                href="/home"><i class="fa-solid fa-house me-1"></i>Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-2 px-0 px-lg-2 rounded"
                                href="/history"><i class="fa-solid fa-receipt me-1"></i>Booking</a></li>
                        <li class="nav-item mx-0 mx-lg-0">
                            <a class="nav-link py-2 px-0 px-lg-2 rounded" data-toggle="modal" data-target="#logoutModal"
                                href="#">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                            </a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-2 px-0 px-lg-2 rounded"
                                href="/pengaturan">
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('picture/accounts/' . Auth::user()->gambar) }}">
                                <span class="d-none d-lg-inline ml-2">{{ Auth::user()->fullname }}</span>
                            </a></li>
                    </ul>
                </div>


            </div>
        </nav>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap mengakhiri sesi saat ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-primary" type="submit">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('halaman_dashboard/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('halaman_dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('halaman_dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('halaman_dashboard/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('halaman_dashboard/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('halaman_dashboard/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('halaman_dashboard/js/demo/chart-pie-demo.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('halaman_dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('halaman_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('halaman_dashboard/js/demo/datatables-demo.js') }}"></script>

    </body>

</html>
