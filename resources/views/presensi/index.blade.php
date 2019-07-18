@extends('master.app')
@section('content')
<div class="card">
  <div class="card-header">
      <b>GRAB PRESENSI</b>
  </div>
  @if(Session::has('alert-success'))
  <div class="alert alert-success">
      <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
  </div>
  @endif
  <div class="card-body">
    <table class="table table-responsive-sm table-bordered text-center" id="table-asisten">
      <thead>
        <tr>
          <th>Jurusan</th>
          <th colspan="2">Jenis</th>
      </thead>
      <tbody>
        @foreach ($jurusan as $key => $data)
            <tr>
            <td>{{$data['nama_jurusan']}}</td>
            <td><a href="{{$data['kode_jurusan']}}">UTS</a></td>
            <td><a href="{{$data['kode_jurusan']}}">UAS</a></td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection