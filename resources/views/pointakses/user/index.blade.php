@extends('layout.index')
@section('title',"Home")
@section('content')
<style>
    .btn-outline-primary {
  --bs-btn-color: #1abc9c;
  --bs-btn-border-color: #1abc9c;
  --bs-btn-hover-color: #fff;
  --bs-btn-hover-bg: #1abc9c;
  --bs-btn-hover-border-color: #1abc9c;
  --bs-btn-focus-shadow-rgb: 26, 188, 156;
  --bs-btn-active-color: #fff;
  --bs-btn-active-bg: #1abc9c;
  --bs-btn-active-border-color: #1abc9c;
  --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  --bs-btn-disabled-color: #1abc9c;
  --bs-btn-disabled-bg: transparent;
  --bs-btn-disabled-border-color: #1abc9c;
  --bs-gradient: none;
}
.card a{
    color: #314051;
    text-decoration: none;
}
</style>
    <h4 class="mt-5">Selamat Datang!</h4>
    <div class="content mt-3 d-flex flex-lg-wrap gap-5 mb-5">
        @if ($data->isEmpty())
            <h1>Kamar Kos Penuh</h1>
        @else
            @foreach ($data as $p)
                <div class="card" style="width:320px;">
                    
                    <div class="card-header m-auto" style="height:100%;width:100%;"><a href="{{ route('user.detail', ['id' => $p->id]) }}">
                        <img src="{{ asset('public/kamar_kos/' . $p->gambar) }}" alt="kamar kos"
                            style="width: 100%; height:200px; object-fit: cover; padding:0;"></a>
                    </div>
                    <div class="card-body">
                        <p class="m-0 text-justify" style="font-size: 16px; font-weight:600;"><a href="{{ route('user.detail', ['id' => $p->id]) }}" style="color: #359690">
                            Kategori: 
                            @if($p->kos->kategori == 'Putra')
                                Kos Putra
                            @elseif($p->kos->kategori == 'Putri')
                                Kos Putri
                                @elseif($p->kos->kategori == 'Campur')
                                Kos Campur
                            @else
                                {{ $p->kos->kategori }}
                            @endif
                        </a></p>
                        <p class="m-0 text-justify" style="font-size: 16px; font-weight:600;"><a href="{{ route('user.detail', ['id' => $p->id]) }}">{{ $p->nomor_kamar }}, {{ $p->kos->nama_kos }} </a></p>
                        {{-- <p class="m-0 text-justify" style="font-size: 16px; font-weight:600;">{{ $p->kos->nama_kos }}</p> --}}
                        <p class="m-0 text-justify"><a href="{{ route('user.detail', ['id' => $p->id]) }}">Alamat Kos: {{ $p->kos->alamat_kos }} </a></p>
                    </div>
                    
                    <div class="card-footer d-flex flex-row justify-content-between align-items-center">
                        <p class="m-0" style="font-size: 16px; font-weight:600; color:#314051 "><span>Rp
                                
                            </span><a href="{{ route('user.detail', ['id' => $p->id]) }}">{{ number_format($p->harga_sewa) }} </a></p>
                            <form action="{{route('pemesanan.index', ['id' => $p->id])}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_kamar_kos" value="{{ $p->id }}">
                                <button type="submit" class="btn btn-outline-primary" style="font-size: 14px;">Booking</button>
                            </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination d-flex flex-row justify-content-between">
            <div class="showData">
                {{-- Data ditampilkan ini route dari ini route --}}
            </div>
            <div>
                {{-- {{ $data->links() }} --}}
            </div>
        </div>
    @endif
@endsection
