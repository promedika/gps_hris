@extends('master')
@section('title')
    Show Employee
@endsection
@section('custom_link_css')
<!-- Select 2 -->
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Employee </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
              <li class="breadcrumb-item active">Show Employee</li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{asset('assets/img/pngwing.com.png')}}"
                         alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">{{$datas['users']->fullname}}</h3>

                  <p class="text-muted text-center">{{$datas['users']->jabatan}}</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">About</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong>NIK</strong>

                  <p class="text-muted">
                    {{$datas['users']->nik}}
                  </p>

                  <hr>

                  <strong>Phone Number</strong>

                  <p class="text-muted">{{$datas['users']->phone}}</p>

                  <hr>

                  <strong>Birth Date</strong>

                  <p class="text-muted">
                    {{date('d M Y', strtotime($datas['users']->birth_date))}}
                  </p>

                  <hr>

                  <strong>Gender</strong>

                  <p class="text-muted">{{$datas['users']->gender}}</p>

                  <hr>

                  <strong>Marital Status</strong>

                  <p class="text-muted">{{$datas['users']->marital_status}}</p>

                  <hr>

                  <strong>Religion</strong>

                  <p class="text-muted">{{$datas['users']->religion}}</p>

                  <hr>

                  <strong>Education Level</strong>

                  <p class="text-muted">{{$datas['users']->education_level}}</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#gps_emp_status" data-toggle="tab">Employee Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gps_emp_structure" data-toggle="tab">Employee Structure</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="gps_emp_status">
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="join_date" class="col-sm-2 col-form-label">Join Date</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($datas['users']->join_date))}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employment_start_date" class="col-sm-2 col-form-label">Employment Start Date</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($datas['users']->start_date))}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employment_status" class="col-sm-2 col-form-label">Employment Status</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->employment_status}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employee_position" class="col-sm-2 col-form-label">Employee Position</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->jabatan}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="job_title" class="col-sm-2 col-form-label">Job Title</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->job_title}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="job_status" class="col-sm-2 col-form-label">Job Status</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->job_status}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="organization_unit" class="col-sm-2 col-form-label">Organization Unit</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->organization_unit}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employee_status" class="col-sm-2 col-form-label">Employee Status</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->employee_status}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="gps_emp_structure">
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="join_date" class="col-sm-2 col-form-label">Join Date</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($datas['users']->join_date))}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employment_start_date" class="col-sm-2 col-form-label">Employment Start Date</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($datas['users']->start_date))}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employment_status" class="col-sm-2 col-form-label">Employment Status</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->employment_status}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employee_position" class="col-sm-2 col-form-label">Employee Position</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->jabatan}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="job_title" class="col-sm-2 col-form-label">Job Title</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->job_title}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="job_status" class="col-sm-2 col-form-label">Job Status</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->job_status}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="organization_unit" class="col-sm-2 col-form-label">Organization Unit</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->organization_unit}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="employee_status" class="col-sm-2 col-form-label">Employee Status</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$datas['users']->employee_status}}" style="background-color: #FFFFFF;" readonly>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
@section('custom_script_js')
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/moment/moment.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
@endsection