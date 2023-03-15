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
            <h2>DETAIL PENGADUAN</h2>
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
                        <td><img src="{{ asset('storage/image/' . $pengaduan->foto) }}" alt="" width="100px"></td>
                    </tr>
                    <tr>
                        <th>Tanggapan</th>
                        <td>:</td>
                        <td>{{$pengaduan->tanggapan->tanggapan ?? '-'}}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
@endsection
