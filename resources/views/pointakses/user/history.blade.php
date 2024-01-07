@extends('layout.index')

@section('title', 'History Pemesanan')

@section('content')
<style>
  .container{
    font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
        "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        
  }
</style>
  <div class="container mt-5">
    <h2 class="mb-4" style="font-weight: 600;">History Pemesanan</h2>

    @if ($historyPemesanan->count() > 0)
      <div class="row">
        @foreach ($historyPemesanan as $history)
          <div class="col-lg-6 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title font-weight-bold mb-3" style="font-weight: 550;">{{ $history->kode_pemesanan }}</h5>
                <p class="card-text">Nama Kos: {{ $history->kamarKos->kos->nama_kos ?? 'Nama Kos Tidak Tersedia' }}</p>
                <p class="card-text">Alamat Kos: {{ $history->kamarKos->kos->alamat_kos ?? 'Alamat Kos Tidak Tersedia' }}</p>
                <p class="card-text">Nomor Kamar: {{ $history->kamarKos->nomor_kamar ?? 'Nomor Kamar Tidak Tersedia' }}</p>
                <p class="card-text">Harga Sewa: {{ number_format($history->kamarKos->harga_sewa ?? '0.0')  }}</p>
                <p class="card-text">Jumlah Kamar: {{ $history->jumlah_kamar ?? '0' }}</p>
                <p class="card-text">Total Pemesanan: {{ number_format($history->total_pemesanan) ?? 'Nomor Kamar Tidak Tersedia' }}</p>
                <p class="card-text">Status: {{ $history->status }}</p>
                <p class="card-text">Tanggal Pemesanan: {{ date('l, d F Y H:i', strtotime($history->tanggal_pemesanan)) ?? 'Nomor Kamar Tidak Tersedia' }} WIB</p>
                <a href="{{ route('transaksi.showInvoice', $history->id) }}" class="btn" style="background-color: #1abc9c; color: white;">Detail</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="card">
        <div class="card-body text-center">
          <h3 class="text-gray-900 font-weight-bold">Tidak ada riwayat pemesanan</h3>
          <p class="text-muted">Anda belum melakukan pemesanan.</p>
          <a href="{{ url('/home') }}" class="btn" style="background-color: #1abc9c; color: white;">Cari Kos</a>
        </div>
      </div>
    @endif
  </div>
@endsection
