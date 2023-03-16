@extends('layout.admin')

@section('content')
<section>
    <div class="row mt-4">
        <div class="col-lg-12 margin-tb">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a class="btn btn-md text-white font-weight-bolder" style="background-color: #5F9DF7; border-radius:7px;"
                    href="/admin/tanggapan">Kembali</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header text-center">
                    Detail Pengaduan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <td>:</td>
                                <td>{{$pengaduan->nik}}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{$pengaduan->masyarakat->nama}}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengaduan</th>
                                <td>:</td>
                                <td>{{$pengaduan->tgl_pengaduan}}</td>
                            </tr>
                            <tr>
                                <th>Isi Laporan</th>
                                <td>:</td>
                                <td>{{$pengaduan->isi_laporan}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    @if($pengaduan->status == '0')
                                    <span class="badge text-black" style="background-color: yellow">Pending</span>
                                    @elseif ($pengaduan->status == 'proses')
                                    <span class="badge" style="background-color: blue;">Proses</span>
                                    @elseif($pengaduan->status == 'selesai')
                                    <span class="badge" style="background-color: green">Selesai</span>
                                    @else
                                    <span class="badge" style="background-color: red">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td>:</td>
                                <td>
                                    <img src="{{asset('storage/image/' . $pengaduan->foto)}}" alt="" width="100px">
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header text-center">
                    Kirim Tanggapan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('tanggapan.createOrUpdate')}}">
                        @csrf
                        <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                        <div class="mb-3">
                          <label for="status" class="form-label">Status</label>
                          <select name="status" id="status" class="form-control">
                            @if ($pengaduan->status == '0')
                                <option value="0" selected>Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif ($pengaduan->status == 'proses')
                                <option value="0">Pending</option>
                                <option value="proses" selected>Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif($pengaduan->status == 'selesai')
                                <option value="0">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai" selected>Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            @else
                                <option value="0">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak" selected>Ditolak</option>
                            @endif
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="tanggapan" class="form-label">Tanggapan</label>
                          <textarea name="tanggapan" id="tanggapan" cols="30" rows="5" class="form-control">{{$tanggapan->tanggapan ?? ''}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
