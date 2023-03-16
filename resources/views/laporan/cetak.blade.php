<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Laporan Pengaduan</title>
</head>

<body>
    <div class="text-center">
        <h5>Laporan Pengaduan Masyarakat Desa Cigombong</h5>
        <p class="text-bold">Periode: {{$from}} sampai {{$to}}</p>
        <p>Jalan Mayor Jendral HR.Edi Sukma No. 1 Telp 02518221328 <br> email: Keccigombong@bogorkab.go.id</p>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Pending</th>
                    <th class="text-center">Proses</th>
                    <th class="text-center">Selesai</th>
                    <th class="text-center">Ditolak</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">{{$pending}}</td>
                    <td class="text-center">{{$proses}}</td>
                    <td class="text-center">{{$selesai}}</td>
                    <td class="text-center">{{$ditolak}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Laporan</th>
                    <th>NIK Pelapor</th>
                    <th>Nama Pelapor</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                    <th>Tanggal Ditanggapi</th>
                    <th>Tanggapan</th>
                    <th>Nama Petugas</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $p)
                    <tr>
                        <td>{{ $p->tgl_pengaduan }}</td>
                        <td>{{ $p->nik }}</td>
                        <td>{{ $p->masyarakat->nama }}</td>
                        <td>{{ $p->isi_laporan }}</td>
                        <td>{{ ucwords($p->status) }}</td>
                        <td>{{$p->tanggapan->tgl_tanggapan}}</td>
                        <td>{{ $p->tanggapan->tanggapan ?? '-' }}</td>
                        <td>{{$p->tanggapan->petugas->nama_petugas}}</td>
                        <td>{{$p->tanggapan->tgl_selesai ?? "-"}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
