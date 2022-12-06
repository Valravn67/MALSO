@extends('layout')
@section('title', 'Warehouse Staff List')

@section('css')
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List</h3>
    </div>
    <div class="card-body">
        <table id="dataTableTechnicianList" class="table table-bordered table-striped text-nowrap" style="text-align: center;">
            <thead>
            <tr>
                <th>ID</th>
                <th>NIK</th>
                <th>Technician Name</th>
            
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->id_technician }}</td>
                <td>{{ $value->nik }}</td>
                <td>{{ $value->name }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
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
      $("#dataTableTechnicianList")
        .DataTable({
          responsive: true,
          lengthChange: false,
          autoWidth: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#dataTableTechnicianList_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection