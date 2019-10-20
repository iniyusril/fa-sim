@extends('master.app')
@section('content')
<div class="card">
        <div class="card-header">
          <strong>Normal</strong> Form</div>
          <form action="{{route('presensi.update')}}" method="post">
            @csrf
        <div class="card-body">
            <input type="hidden" name="id" value="{{$id}}">
            <div class="form-group col-sm-6">
                    <label for="datepicker">Tanggal Mulai</label>
                    <input id="datepicker" width="276" name="tgl_awal" value="{{$tanggal_mulai}}" />
            </div>
            <div class="form-group col-sm-6">
                    <label for="datepicker">Tanggal Selesai</label>
                    <input id="date" width="276" name="tgl_selesai" value="{{$tanggal_selesai}}" />
            </div>
            <div class="form-group row col-sm-6">
                    <label class="col-md-2 col-form-label">Is Aktif</label>
                    <div class="col-md-9 col-form-label">
                      <div class="form-check form-check-inline mr-1">
                          @if ($is_aktif == 0)
                          <input class="form-check-input" id="inline-radio1" type="radio" value="0" name="is_aktif" checked>
                          @else
                          <input class="form-check-input" id="inline-radio1" type="radio" value="0" name="is_aktif">
                          @endif
                        <label class="form-check-label" for="inline-radio1">No</label>
                      </div>
                      <div class="form-check form-check-inline mr-1">
                          @if ($is_aktif == 1)
                          <input class="form-check-input" id="inline-radio2" type="radio" value="1" name="is_aktif" checked>
                          @else
                          <input class="form-check-input" id="inline-radio2" type="radio" value="1" name="is_aktif">
                          @endif
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
