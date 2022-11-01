@extends('master')
@section('title')
    Kategori Pertanyaan
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
          <h1 class="m-0">Kategori Pertanyaan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Kategori Pertanyaan</li>
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
                      <a href="#" title="Add" class="btn btn-primary col-2 btn-add-kategori"><i class="fa solid fa-plus"></i></a>
                    </div>
                    @if(session()->has('message'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('message') }}
                    </div>
                @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered table-hover" id="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $no = 1; @endphp
                          @foreach ($katPers as $KatPer)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$katPer->kategori}}</td>
                            <td>{{$katPer->nama}}</td>
                            <td>
                                <a href="#" outlet-id="{{$katPer->id}}" title="Edit" class="btn btn-warning btn-edit-kategori"><i class="fas fa-edit"></i></a>
                                <a href="#" outlet-id="{{$katPer->id}}" title="Delete" class="btn btn-danger btn-delete-kategori"><i class="fas fa-trash"></i></a>
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
<div class="modal fade in" id="modalCreateKategori" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-signup">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Buat Kategori Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="kategori">Kategori Pertanyaan</label>
            <input type="text" name="kategori" id="kategori" class="form-control" required>
            <span id="errorKategori" class="text-red"></span>
          </div>
          <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
            <span id="errorNama" class="text-red"></span>
          </div>
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

<!-- The Modal Edit -->
<div class="modal fade in" id="modalEditKategori" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id" class="form-control">
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="form-group">
            <label for="kategori">Kategori Pertanyaan</label>
            <input type="text" name="kategori" id="kategori_update" class="form-control" required>
            <span id="errorKategori" class="text-red"></span>
          </div>
          <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" name="nama" id="nama_update" class="form-control" required>
            <span id="errorNama" class="text-red"></span>
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

<!-- The Modal Delete -->
<div class="modal fade in" id="modalDeleteKategori" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-delete">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hapus Kategori</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="hidden" name="id" id="id_delete" class="form-control">
  
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

        $('.btn-add-kategori').click(function(){
            $('#modalCreateKategori').modal('show');

            $('#form-signup').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreateKategori');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('kategori.create')}}",
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
                        $('#errorKategori').text(response.responseJSON.errors.kategori);
                        $('#errorNama').text(response.responseJSON.errors.nama);
                    }

                    
                })
            })
        })


        $('.btn-edit-kategori').click(function(){
            $('#modalEditKategori').modal('show');
            var kategoriID = $(this).attr('kategori-id');
            var id = $('#id').val(kategoriID);
            
            $.ajax({
                url:"{{route('kategori.edit')}}",
                type:'POST',
                data:{
                  id:kategoriID,
                },
                success:function(data){
                    console.log('success edit');
                    $('#kategori_update').val(data.data.kategori);
                    $('#nama_update').val(data.data.nama);
                    $('#form-edit').data('id',kategoriID);
                },
                error:function(response){
                    $('#errorKategori').text(response.responseJSON.errors.kategori);
                    $('#errorNama').text(response.responseJSON.errors.nama);
                }
                
            })

            $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEditKategori');
                let kategoriID = $(this).data('id');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('kategori.update')}}",
                    type:'POST',
                    data:formData,
                    data:{
                      id:kategoriID,
                      kategori:$('#kategori_update').val(),
                      nama:$('#nama_update').val(),
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
                        $('#errorKategori').text(response.responseJSON.errors.kategori);
                        $('#errorNama').text(response.responseJSON.errors.nama);
                    }
                })
            })
        })

        $('.btn-delete-kategori').click(function(){
          $('#modalDeleteKategori').modal('show');
          var kategoriID = $(this).attr('kategori-id');
          var id = $('#id_delete').val(kategoriID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalDeleteKategori');
                // var formData = new FormData(this);
                $.ajax({
                    url:"{{route('kategori.delete')}}",
                    type:'POST',
                    data:{
                      id:kategoriID,
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