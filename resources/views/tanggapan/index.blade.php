@extends('layout.admin')

@section('content')
<section>
    <h2 class="mt-4">LIST PENGADUAN</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
        @foreach ($pengaduan as $p)
        <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title mb-0">{{$p->nik}} |
                    @if($p->status == '0')
                    <span class="badge text-black" style="background-color: yellow">Pending</span>
                    @elseif ($p->status == 'proses')
                    <span class="badge" style="background-color: blue;">Proses</span>
                    @elseif($p->status == 'selesai')
                    <span class="badge" style="background-color: green">Selesai</span>
                    @else
                    <span class="badge" style="background-color: red">Ditolak</span>
                    @endif
                </h5>
                <p class="text-muted mb-1">{{$p->tgl_pengaduan}}</p>
                <p class="card-text">{{$p->isi_laporan}}</p>
                <a href="{{route('pengaduan.kirimTanggapan')}}" class="btn btn-primary">Kirim Tanggapan</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
</section>
@endsection
