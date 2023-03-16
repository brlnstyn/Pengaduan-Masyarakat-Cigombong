<!DOCTYPE html>
<html lang="en">

<head>
    <title>PENGADUAN MASYARAKAT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../landing/vendors/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../landing/vendors/owl-carousel/css/owl.theme.default.css">
    <link rel="stylesheet" href="../landing/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../landing/vendors/aos/css/aos.css">
    <link rel="stylesheet" href="../landing/css/style.min.css">
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100" style="background-color: #f7f8fa;">
    <div class="row mt-4">
        <div class="col-md-11">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a class="btn btn-md text-white font-weight-bolder" style="background-color: #5F9DF7; border-radius:7px;"
                    href="/">Kembali</a>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2>DAFTAR PENGADUAN</h2>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal Laporan</th>
                                <th>Isi Laporan</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Tanggal Ditanggapi</th>
                                <th>Tanggapan</th>
                                <th>Petugas</th>
                                <th>Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $p)
                                <tr>
                                    <td>{{$p->tgl_pengaduan}}</td>
                                    <td>{{$p->isi_laporan}}</td>
                                    <td>
                                        <img src="{{asset('storage/image/' . $p->foto)}}" width="100px" alt="">
                                    </td>
                                    <td>
                                        @if($p->status == '0')
                                        <span class="badge text-black" style="background-color: yellow">Pending</span>
                                        @elseif ($p->status == 'proses')
                                        <span class="badge text-white" style="background-color: blue;">Proses</span>
                                        @elseif($p->status == 'selesai')
                                        <span class="badge text-white" style="background-color: green">Selesai</span>
                                        @else
                                        <span class="badge text-white" style="background-color: red">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$p->tanggapan->tgl_tanggapan ?? '-'}}
                                    </td>
                                    <td>
                                        {{$p->tanggapan->tanggapan ?? '-'}}
                                    </td>
                                    <td>
                                        {{$p->tanggapan->petugas->nama_petugas ?? ''}}
                                    </td>
                                    <td>
                                        {{$p->tanggapan->tgl_selesai ?? '-'}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../landing/vendors/jquery/jquery.min.js"></script>
    <script src="../landing/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../landing/vendors/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../landing/vendors/aos/js/aos.js"></script>
    <script src="../landing/js/landingpage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../../assets/js/datatables-simple-demo.js"></script>
</body>

</html>
