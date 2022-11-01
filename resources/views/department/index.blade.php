@extends('master')
@section('title')
    Department
@endsection
@section('custom_link_css')
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Department</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Department</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <a href="#" title="Add" class="btn btn-primary btn-block col-2 btn-add-department"><i class="fa solid fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered table-hover" id="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Department</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $no = 1; @endphp
                          @foreach ($departments as $department)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$department->name}}</td>
                            <td>
                                <a href="#" department-id="{{$department->id}}" title="Edit" class="btn btn-warning btn-edit-department"><i class="fas fa-edit"></i></a>
                                <a href="#" department-id="{{$department->id}}" title="Delete" class="btn btn-danger btn-delete-department"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<!-- The Modal Add -->
<div class="modal fade in" id="modalCreateDepartment" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-signup">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Buat Departemen Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama Departemen</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <span id="errorName" class="text-red"></span>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- The Modal Edit -->
<div class="modal fade in" id="modalEditDepartment" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Department
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id" class="form-control">
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nama Department</label>
          <input type="text" name="name" id="name_update" value="{{old('name')}}" class="form-control" required>
          <span id="errorName" class="text-red"></span>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal Delete -->
<div class="modal fade in" id="modalDeleteDepartment" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-delete">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="hidden" name="id" id="id_delete" class="form-control">
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('custom_script_js')
<!-- DataTables  & Plugins -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $('.btn-add-department').click(function(){
            $('#modalCreateDepartment').modal('show');

            $('#form-signup').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateDepartment');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('department.create')}}",
                    type:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success create');
                        location.reload();
                    },
                    error:function(response){
                        $('#errorName').text(response.responseJSON.errors.name);
                    }
                })
            })
        })


        $('.btn-edit-department').click(function(){
            $('#modalEditDepartment').modal('show');
            var departmentID = $(this).attr('department-id');
            var id = $('#id').val(departmentID);
            
            $.ajax({
                url:"{{route('department.edit')}}",
                type:'POST',
                data:{
                  id:departmentID,
                },
                success:function(data){
                    console.log(data);
                    $('#name_update').val(data.name);
                    $('#form-edit').data('id',departmentID);
                },
                error:function(response){
                    $('#errorName').text(response.responseJSON.errors.name);
                }
                
            })

            $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEditDepartment');
                let departmentID = $(this).data('id');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('department.update')}}",
                    type:'POST',
                    data:formData,
                    data:{
                      id:departmentID,
                      name:$('#name_update').val(),
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success update');
                        location.reload();
                    },
                    error:function(response){
                        $('#errorName').text(response.responseJSON.errors.name);
                    }
                })
            })
        })

        $('.btn-delete-department').click(function(){
          $('#modalDeleteDepartment').modal('show');
          var departmentID = $(this).attr('department-id');
          var id = $('#id_delete').val(departmentID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalDeleteDepartment');
                $.ajax({
                    url:"{{route('department.delete')}}",
                    type:'POST',
                    data:{
                      id:departmentID,
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success deleted');
                        location.reload();
                    },
                    error:function(response){
                        console.log('success failed');
                    }
                })
            })
        })
    })
</script>
@endsection