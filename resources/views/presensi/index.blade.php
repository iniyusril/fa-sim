@extends('master.app')
@section('content')
<div class="row">
<div class="col-md-12">
<div class="card">
    <div class="card-header">
      <strong>GRAB PRESENSI</strong></div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="kode_jurusan">Kode Jurusan</label>
            <div class="col-md-3">
              <select class="form-control" id="kode_jurusan" name="kode_jurusan">
                    <option disabled>Please select</option>
                  @foreach ($jurusan as $item)
                    <option value="{{$item['kode_jurusan']}}">{{$item['nama_jurusan']}}</option>
                  @endforeach
              </select>
            </div>
          </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="jenis">Jenis</label>
            <div class="col-md-3">
              <select class="form-control" id="jenis" name="jenis">      
                    <option value="uts">UTS</option>
                    <option value="uas">UAS</option>
              </select>
            </div>
          </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-sm btn-primary" type="submit">
        <i class="fa fa-dot-circle-o"></i> Submit</button>
    </div>
  </div>
</div>
</div>
@endsection