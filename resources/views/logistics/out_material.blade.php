@extends('layout')
@section('title', 'Out Materials')

@section('css')
<link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Form Upload Out Materials</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <div class="card-body">
    <div class="col-md-12">
      <form method="post" enctype="multipart/form-data" autocomplete="off">
      {{ csrf_field() }}
        <div class="form-group">
          <label for="warehouse_name">Warehouse Name </label>
            <select class="form-control select2bs4" style="width: 100%;" name="warehouse_id" required>
                <option value="" selected disabled>Select a Warehouse!</option>
                {{-- @foreach ($get_warehouse as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->text }}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
          <label for="nik_technician">Nik Technician</label>
            <select class="form-control select2bs4" style="width: 100%;" name="warehouse_id" required>
                <option value="" selected disabled>Select NIK Technician</option>
                {{-- @foreach ($get_warehouse as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->text }}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
          <label for="select_material">Select Materials</label><br>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                    Launch Default Modal
            </button>
        </div>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
        <div class="form-group" style="text-align: right;">
          <br />
          <button type="submit" class="btn btn-primary">Upload!</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function() {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
@endsection