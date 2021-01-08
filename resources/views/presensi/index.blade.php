@extends('master.app')
@section('content')
<div class="card">
  <div class="card-header">
      <b>GRAB SETTINGS</b>
      <span class="float-right">
        <a href="{{route('presensi.create')}}">Tambah</a>
      </span>
  </div>
  @if(Session::has('alert-success'))
  <div class="alert alert-success">
      <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
  </div>
  @endif
  @if(Session::has('alert-danger'))
  <div class="alert alert-danger">
      <strong>{{ \Illuminate\Support\Facades\Session::get('alert-danger') }}</strong>
  </div>
  @endif
  <div class="card-body">
    <table class="table table-responsive-sm  text-center" id="table-asisten">
      <thead>
        <tr>
          <th>id</th>
          <th>Tahun Ajaran</th>
          <th>Semester</th>
          <th>Jenis</th>
          <th>Tanggal Mulai</th>
          <th>Tanggal Selesai</th>
          <th>Aktif</th>
          {{-- <th></th> --}}
          <th></th>
      </thead>
      <tbody>
        @foreach ($tanggal as $key => $data)
        <tr>
          <td>{{$data['id']}}</td>
          <td>{{$data['thn_ajaran']}}</td>
          <td>
          @if ($data['semester']==1)
              Ganjil
          @else
              Genap
          @endif
          </td>
          <td>{{$data['jenis']}}</td>
          <td>{{$data['tanggal_mulai']}}</td>
          <td>{{$data['tanggal_selesai']}}</td>
          <td>
          @if ($data['is_aktif'])
          <span class="badge badge-success">Active</span>
          @else
          <span class="badge badge-danger">Banned</span>
          @php
          $data['is_aktif'] = 0
          @endphp
          @endif
          </td>
          <td><a href="{{route('presensi.edit',[$data['id'],$data['tanggal_mulai'],$data['tanggal_selesai'],$data['is_aktif']])}}" style="color:#ffc107"><i class="fa fa-pencil"></i></a></td>
          <td><a href="{{ route('presensi.destroy', [$data['id']]) }}" style="color:#f86c6b"><i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="card">
    <div class="card-header">
        <b>GRAB PRESENSI</b>
    </div>
    @if(Session::has('alert-success'))
    <div class="alert alert-success">
        <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
    </div>
    @endif
    @if(Session::has('alert-danger-presensi'))
    <div class="alert alert-danger">
        <strong>{{ \Illuminate\Support\Facades\Session::get('alert-danger-presensi') }}</strong>
    </div>
    @endif
    <div class="card-body">
      <table class="table table-responsive-sm table-bordered text-center" id="table-presensi">
        <thead>
          <tr>
            <th>Jurusan</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($jurusan as $key => $data)
              <tr>
              <td>{{$data['nama_jurusan']}}</td>
              <td><a href="{{route('download',[$data['kode_jurusan'],'uts'])}}">UTS</a></td>
              <td><a href="{{route('download',[$data['kode_jurusan'],'uas'])}}">UAS</a></td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#table-presensi').DataTable({
      "pageLength": 50
    });
} );
</script>
@endpush
