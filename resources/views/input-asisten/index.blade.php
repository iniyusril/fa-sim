@extends('master.app')
@section('content')
<div class="card">
        <div class="card-header">Input Single</div>
        <div class="card-body">
          <form class="form-inline" action="" method="post">
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
            <div class="form-group form-actions">
              <button class="btn btn-sm btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
</div>
<div class="card">
        <div class="card-header">Input Collection</div>
        <div class="card-body">
          <form class="form-inline" action="" method="post">
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
            <div class="form-group form-actions">
              <button class="btn btn-sm btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
</div>
@endsection