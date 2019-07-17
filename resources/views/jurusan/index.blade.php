@extends('master.app')
@section('content')
<div class="card">
    <div class="card-header">
        Jurusan
    </div>
    @if(Session::has('alert-success'))
    <div class="alert alert-success">
        <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
    </div>
    @endif
    <div class="card-body">
      <table class="table table-responsive-sm ui celled table text-center" id="table-jurusan">
        <thead>
          <tr>
            <th>Kode Jurusan</th>
            <th>Nama Jurusan</th>
        </thead>
        <tbody>
          @foreach ($datas as $key => $data)
              <tr>
              <td>{{$data['kode_jurusan']}}</td>
              <td>{{$data['nama_jurusan']}}</td>
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
    $('#table-jurusan').DataTable();
} );
</script>
@endpush
