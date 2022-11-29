@extends('layout')
@section('title', 'Report Stock Materials')

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
        <div class="table-responsive">
            <table id="dataTableMaterial" class="table table-bordered table-striped text-nowrap" style="text-align: center;">
            <thead>
                <tr>
                    <th>Warehouse Name</th>
                    <th>AC-OF-SM-1B</th>
                    <th>AD-SC</th>
                    <th>CLAMP-HOOK</th>
                    <th>Heatshrink</th>
                    <th>KLEM-RING-5-LUBANG</th>
                    <th>ODP-CA-8</th>
                    <th>ODP-SOLID-8-L</th>
                    <th>OTP-FTTH-1</th>
                    <th>PC-SC-SC-10</th>
                    <th>PC-SC-SC-15</th>
                    <th>PC-SC-SC-20</th>
                    <th>PC-SC-SC-30</th>
                    <th>PIGTAIL-SC</th>
                    <th>PREKSO-INTRA-15-RS</th>
                    <th>PREKSO-INTRA-20-RS</th>
                    <th>PROTECTION-SLEEVE</th>
                    <th>PS-1-16-ODP-PB</th>
                    <th>PS-1-2</th>
                    <th>PS-1-4-ODC-288</th>
                    <th>PS-1-8-ODP-PB/PD</th>
                    <th>RJ45-5</th>
                    <th>RJ45-6</th>
                    <th>RS-IN-SC-1</th>
                    <th>S-CLAMP-SPRINER</th>
                    <th>SC-OF-SM-12</th>
                    <th>SC-OF-SM-144</th>
                    <th>SC-OF-SM-24</th>
                    <th>SC-OF-SM-288</th>
                    <th>SOC-ILS</th>
                    <th>SOC-SUM</th>
                    <th>TC-2-160</th>
                    <th>UTP-C6</th>
                    <th>PRECON-1C-50-NOAC</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
             <tbody>
                @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $value->warehouse_name }}</td>
                    {{-- <td>{{ $value->id }}</td> --}}
                </tr> 
                @endforeach
            </tbody>
            </table>
        </div>
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
      $("#dataTableWarehouseList")
        .DataTable({
          responsive: true,
          lengthChange: false,
          autoWidth: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#dataTableWarehouseList_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection