@extends('layout')
@section('title', 'Stock Material')

<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Form Upload Stock Materials</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
    {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="warehouse_name">Warehouse Name *</label>
            <select class="form-control select2bs4" style="width: 100%;" name="warehouse_id">
                @foreach ($get_warehouse as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->text }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="note">Note</label>
          <textarea class="form-control" rows="4" placeholder="Give ur Note, Here!" id="note" name="note"></textarea>
        </div>
        <div class="form-group">
          <label for="upload_stock">Upload Stock *</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="custom-file-input" id="upload_stock" name="upload_stock"/>
              <label class="custom-file-label" for="upload_stock">Choose file</label>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Upload!</button>
      </div>
    </form>
  </div>
</section>

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
@endsection
