@extends('master')
@section('title')
    Division
@endsection
@section('custom_link_css')
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Division</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Division</li>
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
                      <a href="#" title="Add" class="btn btn-primary btn-block col-2 btn-add-division"><i class="fa solid fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered table-hover" id="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>division</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $no = 1; @endphp
                          @foreach ($divisions as $division)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$division->div_name}}</td>
                            <td>
                                <a href="#" division-id="{{$division->id}}" title="Edit" class="btn btn-warning btn-edit-division"><i class="fas fa-edit"></i></a>
                                <a href="#" division-id="{{$division->id}}" title="Delete" class="btn btn-danger btn-delete-division"><i class="fas fa-trash"></i></a>
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
<div class="modal fade in" id="modalCreateDivision" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-create">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Buat Divisi Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama Divisi</label>
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
<div class="modal fade in" id="modalEditDivision" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit divisi
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id" class="form-control">
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nama Division</label>
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
<div class="modal fade in" id="modalDeleteDivision" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-delete">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Division</h4>
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

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('blur', "input[type=text]", function () {
          $(this).val(function (_, val) {
            return val.toUpperCase();
          });
        });

        $(document).on('keyup', "input[type=text]", function () {
          $(this).val(function (_, val) {
            return val.toUpperCase();
          });
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

        $('.btn-add-division').click(function(){
            $('#modalCreateDivision').modal('show');

            $('#form-create').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateDivision');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('division.create')}}",
                    type:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                      modal_id.modal('hide');
                      $('#loader').modal('show');
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(response){
                        alert('failed created');
                        location.reload();
                    }
                })
            })
        })


        $('.btn-edit-division').click(function(){
            $('#modalEditDivision').modal('show');
            var divisionID = $(this).attr('division-id');
            var id = $('#id').val(divisionID);
            
            $.ajax({
                url:"{{route('division.edit')}}",
                type:'POST',
                data:{
                  id:divisionID,
                },
                success:function(data){
                    $('#name_update').val(data.div_name);
                    $('#form-edit').data('id',divisionID);
                },
                error:function(response){
                    $('#errorName').text(response.responseJSON.errors.name);
                }
                
            })

            $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEditDivision');
                let divisionID = $(this).data('id');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('division.update')}}",
                    type:'POST',
                    data:{
                      id:divisionID,
                      name:$('#name_update').val(),
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                      modal_id.modal('hide');
                      $('#loader').modal('show');
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(response){
                        alert('failed edited');
                        location.reload();
                    }
                })
            })
        })

        $('.btn-delete-division').click(function(){
          $('#modalDeleteDivision').modal('show');
          var divisionID = $(this).attr('division-id');
          var id = $('#id_delete').val(divisionID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalDeleteDivision');
                $.ajax({
                    url:"{{route('division.delete')}}",
                    type:'POST',
                    data:{
                      id:divisionID,
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                      modal_id.modal('hide');
                      $('#loader').modal('show');
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(response){
                        alert('failed deleted');
                        location.reload();
                    }
                })
            })
        })

        $(document).on('keyup', "input[type=number]", function (e) {
          e.preventDefault;
          let check = /^\d+$/.test($(this).val());
          if (!check) { $(this).val(''); alert('Input must be a number'); }
        });
    })
</script>
@endsection