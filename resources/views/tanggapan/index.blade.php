@extends('layout.admin')

@section('content')
<section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4">
            <p>{{$message}}</p>
        </div>
    @endif
    <h2 class="mt-4">LIST PENGADUAN</h2>
    <form action="/admin/tanggapan/cari" method="GET" autocomplete="">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <input type="text" id="cari" name="cari" class="form-control" placeholder="Cari berdasarkan status pengaduan..." value="{{old('cari')}}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-md">Cari Pengaduan</button>
            </div>
        </div>
    </form>
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
              </div>
              <div class="card-footer">
                <a href="{{ route('pengaduan.kirimTanggapan', $p->id_pengaduan) }}" class="btn btn-info">Kirim Tanggapan</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="position-absolute bottom-0 end-0 mx-5">
        {{ $pengaduan->links() }}
      </div>
</section>
@endsection
