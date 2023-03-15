@extends('layout.admin')

@section('content')
<section>
    <div class="card mt-4">
        <div class="card-body">
            <h2>LIST MASYARAKAT</h2>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Nomor HP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($masyarakat as $m)
                    <tr>
                        <td>{{$m->nik}}</td>
                        <td>{{$m->nama}}</td>
                        <td>{{$m->username}}</td>
                        <td>{{$m->telp}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
