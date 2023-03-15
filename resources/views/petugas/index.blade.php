@extends('layout.admin')

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
        <h2>BUAT AKUN PETUGAS</h2>
        <form class="row g-3" method="POST" action="{{route('petugas.store')}}">
            @csrf
            <div class="col-md-4">
              <label for="nama_petugas" class="form-label">Nama Petugas</label>
              <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" maxlength="35" required>
            </div>
            <div class="col-md-4">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" maxlength="25" required>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Password</label>
                <input type="Password" class="form-control" id="password" name="password" maxlength="32" required>
              </div>
            <div class="col-md-6">
              <label for="telp" class="form-label">Nomor HP</label>
              <input type="number" class="form-control" id="telp" name="telp" maxlength="13" maxlength="13" required>
            </div>
            <div class="col-md-6">
                <label for="level" class="form-label">Level</label>
                <select name="level" id="level" class="form-control">
                    <option value="0" selected>--Pilih Level--</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Buat Akun</button>
            </div>
          </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h2>LIST PETUGAS</h2>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th>Nomor HP</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($petugas as $p)
                <tr>
                    <td>{{$p->nama_petugas}}</td>
                    <td>{{$p->username}}</td>
                    <td>{{$p->telp}}</td>
                    <td>{{$p->level}}</td>
                    <td>
                        <form action="{{route('petugas.destroy', $p->id_petugas)}}" method="POST">
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
