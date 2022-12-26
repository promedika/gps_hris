@extends('master')
@section('title')
    Employee
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
            <h1 class="m-0">Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                  <a href="{{route('dashboard.user.create')}}" title="Add" class="btn btn-primary col-2 btn-add-user"><i class="fa solid fa-plus"></i></a>
                  <a href="#" title="Add" class="btn btn-success col-2 btn-import-user"><i class="fa solid fa-file-import"></i></a>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('failure'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('failure') }}
                    </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Employee No</th>
                        <th>Employee Name</th>
                        <th>Employment Status</th>
                        <th>Employee Position</th>
                        <th>Employee Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $no = 1; @endphp
                      @foreach ($users as $user)
                        @php if ($user->nik == '123456789') continue; @endphp
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$user->nik}}</td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->employment_status}}</td>
                                <td>{{$user->jabatan}}</td>
                                <td>{{$user->employee_status}}</td>
                                <td>
                                  <a href="{{route('dashboard.user.show', ['id' => $user->id])}}" user-id="{{$user->id}}" title="view" class="btn btn-info btn-view-user"><i class="fas fa-eye"></i></a>
                                  <a href="{{route('dashboard.user.edit', ['id' => $user->id])}}" user-id="{{$user->id}}" title="edit" class="btn btn-warning btn-edit-user"><i class="fas fa-edit"></i></a>
                                  {{--
                                  <a href="#" user-id="{{$user->id}}" data-user="{{$user->fullname}}" title="delete" class="btn btn-danger btn-delete-user"><i class="fas fa-trash"></i></a>
                                  --}}
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade in" id="modal-import-user" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('dashboard.users.upload')}}" method="post" accept-charset="utf-8" id="form-import" enctype="multipart/form-data">
        @csrf
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Import Data Karyawan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <p><font color="red">* Format file harus .xlsx atau .xls</font></p>
          <a class="btn btn-sm btn-info" href="{{asset('/assets/template/user_template.xlsx')}}">Download Template</a><br><br>
          <label for="name">Pilih File</label>
          <input type="file" name="file" class="name" id="name" accept=".xlsx, .xls" required >
          <span id="errorName" class="text-red"></span>
        </div>
      </div>

        <div class="modal-footer">
          <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade in" id="modalDeleteUser" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post" accept-charset="utf-8" id="form-delete">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id_delete" class="form-control">

      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data <span></span> ini ?</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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

        $('.btn-import-user').click(function(){
          $('#modal-import-user').modal('show');
        });

        $('#submit').click(function(){
          $('#modal-import-user').modal('hide');
          $('#loader').modal ('show');
        });

        jQuery("body").on("click", ".btn-delete-user", function(e) {
          $('#modalDeleteUser').find('.modal-body span').text($(this).data("user"));
          $('#modalDeleteUser').modal('show');
          var usrID = $(this).attr('user-id');
          var id = $('#id_delete').val(usrID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateUser');
                $.ajax({
                    url:"{{route('dashboard.users.delete')}}",
                    type:'POST',
                    data:{
                      id:usrID,
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success deleted');
                        location.reload()
                    },
                    error:function(response){
                        console.log('success failed');
                        location.reload()
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