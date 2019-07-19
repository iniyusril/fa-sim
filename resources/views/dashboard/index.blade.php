@extends('master.app')
@section('content')
@if(Session::has('alert-success'))
<div class="alert alert-warning col-sm-6">
    <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
</div>
@endif
<div class="row">
    <div class="col-sm-6">
<div class="card">
    <form class="form-horizontal" action="{{route('dashboard')}}" method="post">
        @csrf
    <div class="card-header">
      <strong>Setting</strong> Form</div>
    <div class="card-body">
          <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
          <label for="exampleInputName2">Tahun Ajaran</label>
          <input class="form-control" name="tha" id="exampleInputName2" type="text" placeholder="contoh : 2019/2020" value="{{$data->tha}}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail2">Semester</label>
          <input class="form-control" name="semester" id="exampleInputEmail2" type="text" placeholder="contoh : 1 (UTS), 2 (UAS)" value="{{$data->semester}}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail2">NPM</label>
          <input class="form-control" name="npm" id="exampleInputEmail2" type="text" placeholder="contoh : 1 (UTS), 2 (UAS)" value="{{$data->npm}}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail2">Password</label>
          <input class="form-control" name="password" id="exampleInputEmail2" type="password" placeholder="Masukan Password" value="{{$data->password}}">
        </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-sm btn-primary" type="submit">
        <i class="fa fa-dot-circle-o"></i> Submit</button>
      <button class="btn btn-sm btn-danger" type="reset">
        <i class="fa fa-ban"></i> Reset</button>
    </div>
    </form>
  </div>
</div>
</div>
@endsection