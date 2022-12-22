@extends('layout')
@section('title', 'Out Materials')

@section('css')
<link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/view.css') }}">
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
            <select class="form-control select2bs4" style="width: 100%;" name="warehouse_name" id="warehouse_id" required>
                <option value="" selected disabled>Select a Warehouse!</option>
                @foreach ($get_warehouse as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->text }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="nik_technician">NIK Technician</label>
            <select class="form-control select2bs4" style="width: 100%;" name="nik" required>
                <option value="" selected disabled>Select NIK Technician</option>
                @foreach ($get_technician as $technician)
                <option value="{{ $technician->id }}">{{ $technician->text }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="note">Note</label>
          <textarea class="form-control" rows="4" placeholder="No RFC serta keterangannya" id="note" name="note"></textarea>
        </div>
        {{-- modal input material --}}
        <div class="form-group">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input-material">Input Material's</button>
            <div class="modal fade" id="input-material">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">List Material's</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> 
                  <div class="modal-body" id="mats">
                  {{-- ajax input material --}}
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#input-nte">Input NTE's</button>
        </div>
        <div class="form-group" style="text-align: right;">
          <br/>
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

    $('#input-material').on('click',function(e) {
      $.ajax({
      url: `/ajax/call_out_material`,
      method: 'GET',
      data: {id: $('#warehouse_id').val()},
      dataType: 'json',
      }).done(function (e) {
        console.log(e)
        var html = "";
        $.each(e, function(key, value) {
          html += `<div class="form-group">           
                    <label for="${value.designator_type}" class="col-sm-6 col-form-label">${value.designator_type}</label>
                    <div class="number">
                      <span class="minus">-</span>
                        <input type="text" class="col-sm-2 col-form-label" id="${value.designator_type}">
                      <span class="plus">+</span>
                    </div>
                  </div>`
        })
        $('.modal-body').html(html)
      })
    })

    $(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});

  });

  
</script>
@endsection