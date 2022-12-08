@extends('layout')
@section('title', 'Technician List')

@section('css')

<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
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
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-add">Add Technician</button>
        <table id="dataTableTechnicianList" class="table table-bordered table-striped text-nowrap" style="text-align: center;">
            <thead>
            <tr>
                <th>ID</th>
                <th>NIK</th>
                <th>Technician Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->id_technician }}</td>
                <td>{{ $value->nik }}</td>
                <td>{{ $value->name }}</td>
                <td><i type="button" class="tombol_edit fas fa-light fa-pencil-alt" data-toggle="modal" data-id="{{$value->id_technician}}" data-target="#modal-edit"> Edit</i></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- Modal-Content Add Technician --}}
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Technician</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nik">NIK Technician</label>
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Input NIK Technician">
                </div>
                <div class="form-group">
                    <label for="name">Name Technician</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Input name Technician">
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
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>

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

    $(".tombol_edit").on('click', function(){
      var id_teknisi = $(this).data('id');
      
      $.ajax({
        method:'GET',
        data: {id: id_teknisi},
        url: '/ajax/get_teknisi',
        datatype: 'JSON'
      }).done(function(e){
        var name = e.name,
        nik = e.nik,
        id = e.id_technician ;
        console.log(name, e)
        $("#nik_edit").val(nik)
        $("#name_edit").val(name)
        $("#id_edit").val(id)

      })
    })
</script>
@endsection