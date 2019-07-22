@extends('master.app')
@section('content')
<div class="card">
    <div class="card-header">
        <b>Matakuliah</b>
    </div>
    @if(Session::has('alert-success'))
    <div class="alert alert-success">
        <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
    </div>
    @endif
    <div class="card-body">
      <table class="table table-responsive-sm ui celled table text-center" id="table-asisten">
        <thead>
          <tr>
            <th>Kode Matakuliah</th>
            <th>Nama Matakuliah</th>
            <th>SKS</th>
            <th>Kode Jurusan</th>
        </thead>
        <tbody>
          @foreach ($datas as $key => $data)
              <tr>
              <td>{{$data['kode_mkl']}}</td>
              <td>{{$data['mkl']}}</td>
              <td>{{$data['sks']}}</td>
              <td>{{$data['kode_jurusan']}}</td>
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
    $('#table-asisten').DataTable();
} );
</script>
@endpush
