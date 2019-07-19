@extends('master.app')
@section('content')
@if(Session::has('alert-success'))
<div class="alert alert-danger">
    <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
</div>
@endif
<div class="card">
        <div class="card-header">Input Single</div>
        <div class="card-body">
          <form class="form-inline" action="{{route('remove.single')}}" method="post">
              @csrf
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">NPM</span>
                </div>
                <input class="form-control" id="npm" type="text" name="npm">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Kode_Matakuliah</span>
                </div>
                <input class="form-control" id="kode_matakuliah" type="text" name="kode_matakuliah">
              </div>
            </div>
            <div class="form-group form-actions" style="margin-left:10px">
              <button class="btn btn-sm btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
</div>
<div class="card">
        <div class="card-header">Input Collection</div>
        <div class="card-body">
                <form action="{{route('remove.collection')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label> Please Select File (CSV Comma Delimeted only):</label>
                    <input type="file" name="file"/>
                    <button class="btn btn-sm btn-primary" type="submit">Upload</button>
                </form>
        </div>
</div>
@endsection