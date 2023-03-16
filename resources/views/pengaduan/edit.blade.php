@extends('layout.masyarakat')

@section('content')
<section>
    <div class="row mt-4">
        <div class="col-lg-12 margin-tb">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a class="btn btn-md text-white font-weight-bolder" style="background-color: #5F9DF7; border-radius:7px;"
                    href="/pengaduan">Kembali</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2>EDIT PENGADUAN</h2>
            <form class="row g-3" method="POST" action="{{route('pengaduan.update', $pengaduan->id_pengaduan)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-3">
                  <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                  <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan" value="{{date("Y-m-d")}}" readonly required>
                </div>
                <div class="col-md-3">
                  <label for="nik" class="form-label">NIk</label>
                  <input type="number" class="form-control" id="nik" name="nik" value="{{$nik}}" readonly required>
                </div>
                <div class="col-md-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                  </div>
                  <div class="col-md-3">
                    <label for="akses" class="form-label">Akses</label>
                    <select name="akses" id="akses" class="form-control">
                        <option value="0" selected>--Pilih Hak Akses--</option>
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
                <div class="col-md-12">
                  <label for="isi_laporan" class="form-label">Isi Laporan</label>
                  <textarea name="isi_laporan" id="isi_laporan" cols="30" rows="5" class="form-control">{{$pengaduan->isi_laporan}}</textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Edit Pengaduan</button>
                </div>
              </form>
        </div>
    </div>
</section>
@endsection
