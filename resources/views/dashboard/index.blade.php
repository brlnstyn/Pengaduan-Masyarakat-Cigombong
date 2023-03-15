@extends('layout.admin')

@section('content')
<section>
    @if ($message = Session::get('error'))
        <div class="alert alert-danger mt-4">
            <p>{{$message}}</p>
        </div>
    @endif
    <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white text-center mb-4">
                <div class="card-body"><h3>Pending</h3></div>
                <div class="card-footer">
                    <h3 class="text-center">{{$pending}}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white text-center mb-4">
                <div class="card-body"><h3>Proses</h3></div>
                <div class="card-footer">
                    <h3 class="text-center">{{$proses}}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white text-center mb-4">
                <div class="card-body"><h3>Selesai</h3></div>
                <div class="card-footer">
                    <h3 class="text-center">{{$selesai}}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white text-center mb-4">
                <div class="card-body"><h3>Ditolak</h3></div>
                <div class="card-footer">
                    <h3 class="text-center">{{$ditolak}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
