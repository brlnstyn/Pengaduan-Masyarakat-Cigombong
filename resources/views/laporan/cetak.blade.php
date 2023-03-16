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
        <h5>Laporan Pengaduan Masyarakat Desa Cigombong <br> {{ date('Y-m-d') }}</h5>
        <p>Jalan Mayor Jendral HR.Edi Sukma No. 1 Telp 02518221328 <br> email: Keccigombong@bogorkab.go.id</p>
    </div>
    <div class="container">
        <table class="table table-bordered">
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
                        <td>{{ ucwords($p->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
