@extends('master.app')
@section('content')
<div class="card">
        <div class="card-header">
          <strong>Normal</strong> Form</div>
          <form action="{{route('presensi.store')}}" method="post">
            @csrf
        <div class="card-body">
            <div class="form-group col-sm-6">
              <label for="thn_ajaran">Tahun Ajaran</label>
              <input class="form-control col-md-6" id="thn_ajaran" type="text" name="thn_ajaran" placeholder="Masukan tahun ajaran ..">
            </div>
            <div class="form-group">
                    <label class="col-md-1 col-form-label" for="semester">Semester</label>
                    <div class="col-md-2">
                      <select class="form-control" id="semester" name="semester">
                        <option value="1">Ganjil</option>
                        <option value="2">Genap</option>
                      </select>
                    </div>
            </div>
            <div class="form-group">
                    <label class="col-md-1 col-form-label" for="jenis">Jenis</label>
                    <div class="col-md-2">
                      <select class="form-control" id="jenis" name="jenis">
                        <option value="UTS">UTS</option>
                        <option value="UAS">UAS</option>
                      </select>
                    </div>
            </div>
            <div class="form-group col-sm-6">
                    <label for="datepicker">Tanggal Mulai</label>
                    <input id="datepicker" width="276" name="tgl_awal"/>
            </div>
            <div class="form-group col-sm-6">
                    <label for="datepicker">Tanggal Selesai</label>
                    <input id="date" width="276" name="tgl_selesai"/>
            </div>
            <div class="form-group row col-sm-6">
                    <label class="col-md-2 col-form-label">Is Aktif</label>
                    <div class="col-md-9 col-form-label">
                      <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="inline-radio1" type="radio" value="0" name="is_aktif">
                        <label class="form-check-label" for="inline-radio1">No</label>
                      </div>
                      <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="inline-radio2" type="radio" value="1" name="is_aktif">
                        <label class="form-check-label" for="inline-radio2">Yes</label>
                      </div>
                    </div>
                  </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-primary" type="submit">
            <i class="fa fa-dot-circle-o"></i> Submit</button>
          <button class="btn btn-sm btn-danger" type="reset">
            <i class="fa fa-ban"></i> Reset</button>
        </div>
      </div>
    </form>
      <script>
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4'
            });
            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4'
            });
    </script>
@endsection