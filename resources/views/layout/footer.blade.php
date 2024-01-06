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
    {{-- <link href="{{ asset('halaman_depan/css/styles.css') }}" rel="stylesheet" /> --}}
</head>

<body>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        footer {
            background-color: #314051;
            color: #fff;
            padding: 50px 0;
            /* Sesuaikan padding atas dan bawah sesuai kebutuhan */
            width: 100%;
            box-sizing: border-box;
           
        }

        footer .container {
            max-width: 1200px;
            /* Sesuaikan lebar maksimum sesuai kebutuhan */
            margin: 0 auto;
           
        }
        h4{
            font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
                    "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 700;
        }

        footer .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        footer .col-lg-4 {
            flex: 0 0 calc(33.333% - 20px);
            /* Sesuaikan lebar kolom sesuai kebutuhan */
            margin-bottom: 0px;
            /* Sesuaikan margin bawah sesuai kebutuhan */
            
        }

        .btn-outline-light {
            border-color: #fff;
            color: #fff;
        }

        .btn-outline-light:hover {
            background-color: #fff;
            color: #314051;
        }

        .copyright {
            background-color: #1D242E;
            color: #fff;
            padding: 15px 0;
            width: 100%;
            position: absolute;
            /* Position at the bottom */
            /* Set bottom boundary */
            left: 0;
            /* Extend to left edge */
            right: 0;
            /* Extend to right edge */
            /* Ensure full width */
            text-align: center;
        }
    </style>

    <!-- Footer Section-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Lokasi</h4>
                    <p class="lead mb-0">
                        Sarijadi, Bandung
                        <br />
                        Jawa Barat
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Temui Kami Di</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-dribbble"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Tentang KosConnect</h4>
                    <p class="lead mb-0">
                        KosConnect adalah tempat untuk menemukan kos yang sesuai dengan preferensi calon penyewa,
                        website ini dibuat oleh tim
                        <a href="#">KosConnect</a>
                        .
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; KosConnect 2023</small></div>
    </div>

</body>

</html>
