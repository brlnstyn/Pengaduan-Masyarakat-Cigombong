@extends('layout.masyarakat')

@section('content')
<section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4">
            <p>{{$message}}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger mt-4">
            <p>{{$message}}</p>
        </div>
    @endif
    <div class="card mt-4">
        <div class="card-body">
            <h2>BUAT PENGADUAN</h2>
            <form class="row g-3" method="POST" action="{{route('pengaduan.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                  <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                  <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan" value="{{date("Y-m-d")}}" readonly required>
                </div>
                <div class="col-md-4">
                  <label for="nik" class="form-label">NIk</label>
                  <input type="number" class="form-control" id="nik" name="nik" value="{{$nik}}" readonly required>
                </div>
                <div class="col-md-4">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                  </div>
                <div class="col-md-12">
                  <label for="isi_laporan" class="form-label">Isi Laporan</label>
                  <textarea name="isi_laporan" id="isi_laporan" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Buat Pengaduan</button>
                </div>
              </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h2>LIST PENGADUAN</h2>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Tanggal Pengaduan</th>
                        <th>Isi Laporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $p)
                    <tr>
                        <td>{{$p->tgl_pengaduan}}</td>
                        <td>{{$p->isi_laporan}}</td>
                        <td>
                            @if($p->status == '0')
                            <span class="badge text-black" style="background-color: yellow">Pending</span>
                            @elseif ($p->status == 'proses')
                            <span class="badge" style="background-color: blue;">Proses</span>
                            @elseif($p->status == 'selesai')
                            <span class="badge" style="background-color: green">Selesai</span>
                            @else
                            <span class="badge" style="background-color: red">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{route('pengaduan.destroy', $p->id_pengaduan)}}" method="POST">
                                <a href="{{route('pengaduan.edit', $p->id_pengaduan)}}" class="btn btn-primary">Edit</a>
                                <a href="{{route('pengaduan.show', $p->id_pengaduan)}}" class="btn btn-info">Detail</a>

                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
