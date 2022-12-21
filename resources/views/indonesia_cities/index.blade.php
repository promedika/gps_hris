@extends('master')
@section('title')
    Kab/Kota
@endsection
@section('custom_link_css')
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select 2 -->
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<style>
  .select2-container--default .select2-selection--single {
    height: auto;
    padding: 0.375rem 0;
    border: 1px solid #ced4da;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 24px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
  }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kabupaten/Kota</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Kabupaten/Kota</li>
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
                      <a href="#" title="Add" class="btn btn-primary btn-block col-2 btn-add-indonesia_cities"><i class="fa solid fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered table-hover" id="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Kabupaten/Kota</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $no = 1; @endphp
                          @foreach ($indonesia_cities as $indonesia_cities)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$indonesia_cities->name}}</td>
                            <td>
                                <a href="#" indonesia_cities-id="{{$indonesia_cities->id}}" title="Edit" class="btn btn-warning btn-edit-indonesia_cities"><i class="fas fa-edit"></i></a>
                                <a href="#" indonesia_cities-id="{{$indonesia_cities->id}}" title="Delete" class="btn btn-danger btn-delete-indonesia_cities"><i class="fas fa-trash"></i></a>
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
<div class="modal fade in" id="modalCreateindonesia_cities" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-create">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Buat Kabupaten/Kota</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
              <label for="province">Provinsi</label>
              <select class="form-control select2" style="width: 100%; height: 100%;" id="province" name="province" required>
                  <option value="" style="display:none;">Pilih Provinsi</option>
                  @foreach ($indonesia_provinces as $indonesia_province)
                  <option value="{{$indonesia_province->code}}">{{$indonesia_province->name}}</option>
                  @endforeach
              </select>
              <span id="errorprovince" class="text-red"></span>
            </div>
            <div class="form-group">
              <label for="name">Nama Kabupaten/Kota</label>
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
<div class="modal fade in" id="modalEditindonesia_cities" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Kabupaten/Kota
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id" class="form-control">
      <input type="hidden" name="old_province_code" id="old_province_code" class="form-control">
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="form-group">
              <label for="province">Provinsi</label>
              <select class="form-control select2" style="width: 100%; height: 100%;" id="province_update" name="province" required>
                  <option value="" style="display:none;">Pilih Provinsi</option>
                  @foreach ($indonesia_provinces as $indonesia_province)
                  <option value="{{$indonesia_province->code}}">{{$indonesia_province->name}}</option>
                  @endforeach
              </select>
              <span id="errorprovince" class="text-red"></span>
            </div>
        <div class="form-group">
          <label for="name">Nama Kabupaten/Kota</label>
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
<div class="modal fade in" id="modalDeleteindonesia_cities" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-delete">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Kabupaten/Kota</h4>
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
<!-- Select 2 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>

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

        $('#province, #province_update').select2({
            placeholder: 'Search',
            width: '100%'
        });

        $('.btn-add-indonesia_cities').click(function(){
            $('#modalCreateindonesia_cities').modal('show');

            $('#form-create').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateindonesia_cities');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('indonesia_cities.create')}}",
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
                      alert(data);
                      location.reload();
                    },
                    error:function(response){
                      alert(data);
                      location.reload();
                    }
                })
            })
        })


        $("body").on("click", ".btn-edit-indonesia_cities", function(e) {
            $('#modalEditindonesia_cities').modal('show');
            var ID = $(this).attr('indonesia_cities-id');
            var id = $('#id').val(ID);
            
            $.ajax({
                url:"{{route('indonesia_cities.edit')}}",
                type:'POST',
                data:{
                  id:ID,
                },
                success:function(data){
                    $('#name_update').val(data.cities.name);
                    $('#form-edit').data('id',ID);
                    $('#old_province_code').val(data.cities.province_code);

                    let province_update = $('#province_update');
                    province_update.find('option').remove();

                    htmlInner = '<option value="'+data.cities.province_code+'">'+data.provinces_edit.name+'</option>';
                      $.each(data.provinces, function(k, v) {
                          if (v.code != data.cities.province_code) {
                            htmlInner += '<option value="'+v.code+'">'+v.name+'</option>';
                          }
                      });
                    province_update.append(htmlInner);
                },
                error:function(response){
                    alert('Error');
                    location.reload();
                }
                
            })

            $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEditindonesia_cities');
                $.ajax({
                    url:"{{route('indonesia_cities.update')}}",
                    type:'POST',
                    data:{
                      id:ID,
                      name:$('#name_update').val(),
                      province:$('#province_update').val(),
                      old_province_code:$('#old_province_code').val()
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                      modal_id.modal('hide');
                      $('#loader').modal('show');
                    },
                    success:function(data){
                      alert(data);
                      location.reload();
                    },
                    error:function(data){
                      alert(data);
                      location.reload();
                    }
                })
            })
        })

        // $('.btn-delete-indonesia_cities').click(function(){
        $("body").on("click", ".btn-delete-indonesia_cities", function(e) {
          $('#modalDeleteindonesia_cities').modal('show');
          var ID = $(this).attr('indonesia_cities-id');
          var id = $('#id_delete').val(ID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalDeleteindonesia_cities');
                $.ajax({
                    url:"{{route('indonesia_cities.delete')}}",
                    type:'POST',
                    data:{
                      id:ID,
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                      modal_id.modal('hide');
                      $('#loader').modal('show');
                    },
                    success:function(data){
                      alert('Success');
                      location.reload();
                    },
                    error:function(data){
                      alert('Failed');
                      location.reload();
                    }
                })
            })
        })
    })
</script>
@endsection