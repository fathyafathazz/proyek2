@extends('layout.index')
@section('content')
    <style>
        .btn-primary {
            --bs-btn-border-color: #1abc9c;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #15967d;
            --bs-btn-hover-border-color: #15967d;
            --bs-btn-focus-shadow-rgb: 26, 188, 156;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #15967d;
            --bs-btn-active-border-color: #15967d;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #1abc9c;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #1abc9c;
            --bs-gradient: none;
            outline-width: 3pt;
        }

        body {
            margin-top: 50px;
            margin-bottom: 50px;
            /* Menambahkan margin bawah pada body */
        }

        .nav {
            margin-bottom: 50px;
        }

        .grid-margin {
            margin-top: 20px;
            margin-bottom: 20px;
            /* Menambahkan margin bawah pada elemen dengan kelas grid-margin */
        }

        .footer {
            margin-top: 50px;
            /* Menambahkan margin atas pada elemen dengan kelas footer */
        }
    </style>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2 text-center">FORM PEMESANAN KAMAR KOS</h4>
                <h6 class="card-title mb-1 text-center">{{ $data->kos->nama_kos }}, {{ $data->nomor_kamar }} </h6>
                <h6 class="card-title mb-1 text-center">{{ $data->kos->alamat_kos }}</h6>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('checkout') }}" enctype="multipart/form-data">
                    @csrf
                    
                        <input type="hidden" name="id_kamar_kos" value="{{ $data->id }}">


                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama_pemesan">Nama Pemesan</label>
                                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                        required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="alamat_pemesan">Alamat Pemesan</label>
                                    <input type="text" class="form-control" id="alamat_pemesan" name="alamat_pemesan"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled selected>--- Pilih ---</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="jumlah_kamar">Jumlah Kamar</label>
                                    <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar"
                                        value="{{ old('jumlah_kamar', session('jumlah_kamar_tersedia', 1)) }}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="harga_sewa">Harga Sewa</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="harga_sewa"
                                            value="{{ number_format($data->harga_sewa) }}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="total_pemesanan">Total Pemesanan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="total_pemesanan"
                                            name="total_pemesanan" value="{{ number_format($data->total_pemesanan) }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" style="background-color: #1CBB9C; color:#fff">Pesan
                            Sekarang</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahKamarInput = document.getElementById('jumlah_kamar');
            const hargaSewaInput = document.getElementById('harga_sewa');
            const totalPemesananInput = document.getElementById('total_pemesanan');

            // Fungsi untuk memformat nilai ke dalam format mata uang dengan simbol koma dan titik
            function formatToCurrency(value) {
                return new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0, // Menetapkan jumlah digit minimum di belakang koma
                    maximumFractionDigits: 0 // Menetapkan jumlah digit maksimum di belakang koma
                }).format(value);
            }

            // Fungsi untuk menghitung total pemesanan
            function updateTotalPemesanan() {
                const jumlahKamar = parseInt(jumlahKamarInput.value);
                const hargaSewa = parseInt('{{ $data->harga_sewa }}');

                const totalPemesanan = jumlahKamar * hargaSewa;

                // Set nilai total_pemesanan pada input dengan format mata uang
                totalPemesananInput.value = formatToCurrency(totalPemesanan);
            }

            // Tambahkan event listener untuk perubahan nilai jumlah_kamar
            jumlahKamarInput.addEventListener('input', updateTotalPemesanan);

            // Panggil fungsi pertama kali untuk menginisialisasi nilai
            updateTotalPemesanan();
        });
    </script>




@endsection
