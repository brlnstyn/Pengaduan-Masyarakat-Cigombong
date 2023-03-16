@extends('layout.admin')

@section('content')
    <section>
        <h2 class="mt-3">BUAT LAPORAN</h2>
        <div class="row mt-4">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        Cari Berdasarkan Tanggal
                    </div>
                    <div class="card-body">
                        <form action="{{ route('laporan.getLaporan') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="from" class="form-control" placeholder="Tanggal Awal"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="to" class="form-control" placeholder="Tanggal Akhir"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%">Cari Laporan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header mb-2">
                        Data Berdasarkan Tanggal
                        <div class="float-right mt-2">
                            @if ($pengaduan ?? '')
                                <a href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to]) }}"
                                    class="btn btn-danger">EXPORT PDF</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($pengaduan ?? '')
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>NIK</th>
                                        <th>Isi Laporan</th>
                                        <th>Tanggapan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduan as $p)
                                        <tr>
                                            <td>{{ $p->tgl_pengaduan }}</td>
                                            <td>{{ $p->nik }}</td>
                                            <td>{{ $p->isi_laporan }}</td>
                                            <td>{{ $p->tanggapan->tanggapan ?? '-' }}</td>
                                            <td>
                                                @if ($p->status == '0')
                                                    <a href="" class="badge text-black"
                                                        style="background-color: yellow; text-decoration: none;">Pending</a>
                                                @elseif($p->status == 'proses')
                                                    <a href="" class="badge"
                                                        style="background-color: blue; text-decoration: none;">Proses</a>
                                                @elseif($p->status == 'ditolak')
                                                    <a href="" class="badge"
                                                        style="background-color: red; text-decoration: none;">Ditolak</a>
                                                @else
                                                    <a href="" class="badge"
                                                        style="background-color: green; text-decoration: none;">Selesai</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center">
                                Tidak ada data
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
