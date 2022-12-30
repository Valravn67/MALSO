@extends('layout')
@section('title', 'Report Out Materials')

@section('css')
<link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection

@section('content')

<div class="card-body">
    <form method="GET">
        <div class="col-md-12 row" style="vertical-align: middle; text-align: center">
            <div class="form-group col-md-10">
                <select class="form-control select2bs4" style="width: 100%;" name="id_warehouse" required>
                    <option value="" selected disabled>Select a Warehouse!</option>
                    @foreach ($get_warehouse as $warehouse)
                    <option data-subtext="description 1" value="{{ $warehouse->id }}" <?php if ($warehouse->id == $id) { echo "Selected"; } else { echo ""; } ?>>{{ $warehouse->text }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">List</h3>
    </div>
    <div class="card-body">        
        <table id="dataTableOutMaterials" class="table table-bordered table-striped text-nowrap" style="text-align: center;">
            <thead>
                <tr>
                    <th>Designator Type</th>
                    <th>Designator</th>
                    <th>Terpakai</th>
                    <th>Sisa</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $value)
                <tr>
                    <td>{{ $value->designator_type }}</td>
                    <td>{{ $value->designator }}</td>
                    <td><a href="/report/detail_material?id_warehouse={{ $id }}&id_mats={{ $value->id_designator }}">{{ $value->terpakai }}</a></td>
                    <td>{{ $value->sisa }}</td>            
                </tr>
            @endforeach 
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
$(function () {
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $("#dataTableOutMaterials")
    .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
        .buttons()
        .container()
        .appendTo("#dataTableOutMaterials_wrapper .col-md-6:eq(0)");
});
</script>
@endsection