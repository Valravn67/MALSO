@extends('layout')
@section('title', 'Detail Material')

@section('css')
<link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        {{--  <h3 class="card-title">{{ $data->designator }}</h3> --}}
        <h3 class="card-title">{{ $data[0]->designator }}</h3>
    </div>

    <div class="card-body">        
        <table id="dataTableOutMaterials" class="table table-bordered table-striped text-nowrap" style="text-align: center;">
            <thead>
                <tr>
                    <th>Teknisi</th>
                    <th>Terpakai</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
         <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($data as $value)
            @php
                $total += $value->qty;
            @endphp
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->qty }}</td>
                    <td>{{ $value->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td><b>Total</b></td>
                    <td><b>{{ $total }}</b></td>
                </tr>
            </tfoot>
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
        buttons: ["copy", "excel", "pdf", "print", "colvis"],
    })
        .buttons()
        .container()
        .appendTo("#dataTableOutMaterials_wrapper .col-md-6:eq(0)");
});
</script>
@endsection