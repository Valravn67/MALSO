@extends('layout')
@section('title', 'Warehouse Staff List')

@section('css')

<link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}" />
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
        <table id="dataTableWarehouseList" class="table table-bordered table-striped text-nowrap" style="text-align: center;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Warehouse</th>
                <th>Staff 1</th>
                <th>Staff 2</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->id_warehouse }}</td>
                <td>{{ $value->warehouse_name }}</td>
                <td>{{ $value->name_staff_1 }} ( {{ $value->nik_staff_1 }} )</td>
                <td>{{ $value->name_staff_2 }} ( {{ $value->nik_staff_2 }} )</td>
                <td><i type="button" class="tombol_edit fas fa-light fa-pencil-alt" data-toggle="modal" data-id="{{$value->id_technician}}" data-target="#modal-edit"> Edit</i></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
    {{-- Modal-Content Add Technician --}}
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
            <form method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="id">Warehouse ID</label>
                    <input type="text" class="form-control" id="idwh" name="idwh" placeholder="Input Warehouse ID">
                </div>
                <div class="form-group">
                    <label for="name">Warehouse Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Input Warehouse Name">
                </div>
                <div class="form-group">
                    <label for="name">Staff Name</label>
                    <input type="text" class="form-control" id="staffnik" name="staffnik" placeholder="Input Staff Name">
                </div>
                <div class="form-group">
                    <label for="name">Staff NIK</label>
                    <input type="text" class="form-control" id="staffname" name="staffname" placeholder="Input Staff NIK">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      {{-- Modal-Content Edit Technician --}}
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Edit Data Technician</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form method="post" action="/admin/update_teknisi" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" id="id_edit" name="id">
                    <div class="form-group">
                        <label for="nik">NIK Technician</label>
                        <input type="text" class="form-control" id="nik_edit" name="nik" placeholder="Input NIK Technician">
                    </div>
                    <div class="form-group">
                        <label for="name">Name Technician</label>
                        <input type="text" class="form-control" id="name_edit" name="name" placeholder="Input name Technician">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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