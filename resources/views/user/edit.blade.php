@extends('master')
@section('title')
    Edit Employee
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
            <h1>Edit Employee </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Beranda</a></li>
              @if (Auth::user()->role == 0 || Auth::user()->role == 1)
              <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">Employee</a></li>
              @endif
              <li class="breadcrumb-item active">Edit Employee</li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" accept-charset="utf-8" id="form-edit" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$datas->id}}" readonly>

                <!-- Employee Personal Data -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Employee Personal Data</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="nik">EMPLOYEE NO (NIK) <span style="color: red;">*</span></label>
                          <input type="number" name="nik" id="nik" class="form-control" value="{{$datas->nik}}" readonly>
                          <span id="errorNik" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="fullname">EMPLOYEE NAME <span style="color: red;">*</span></label>
                          <input type="text" name="fullname" id="fullname" class="form-control" value="{{$datas->fullname}}" required>
                          <span id="errorFullName" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone">PHONE NUMBER <span style="color: red;">*</span></label>
                          <input type="number" name="phone" id="phone" class="form-control" value="{{$datas->phone}}" readonly>
                          <span id="errorFullName" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="birth_date">BIRTH DATE <span style="color: red;">*</span></label>
                          <div class="input-group datepicker" data-target-input="nearest" data-toggle="datetimepicker">
                            <input type="text" name="birth_date" id="birth_date" class="form-control" placeholder="DD/Month/YYYY" value="{{$datas->birth_date}}" readonly required>
                            <div class="input-group-append" >
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <span id="errorBirthDate" class="text-red"></span>
                        </div>
                      </div>

                      <input type="hidden" value="promedika" name="password" id="password" class="form-control">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="gender">GENDER <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="gender" name="gender" required>
                              <option value="" style="display:none;">CHOOSE GENDER</option>
                              <option value="MEN" @php if ($datas->gender == 'MEN') { echo 'selected'; } @endphp >MEN</option>
                              <option value="WOMEN" @php if ($datas->gender == 'WOMEN') { echo 'selected'; } @endphp >WOMEN</option>
                          </select>
                          <span id="errorGender" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="religion">RELIGION <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="religion" name="religion" required>
                              <option value="" style="display:none;">CHOOSE RELIGION</option>
                              <option value="ISLAM" @php if ($datas->religion == 'ISLAM') { echo 'selected'; } @endphp >ISLAM</option>
                              <option value="CHRISTIAN" @php if ($datas->religion == 'CHRISTIAN') { echo 'selected'; } @endphp >CHRISTIAN</option>
                              <option value="CATHOLIC" @php if ($datas->religion == 'CATHOLIC') { echo 'selected'; } @endphp >CATHOLIC</option>
                              <option value="HINDUISM" @php if ($datas->religion == 'HINDUISM') { echo 'selected'; } @endphp >HINDUISM</option>
                              <option value="BUDDHISM" @php if ($datas->religion == 'BUDDHISM') { echo 'selected'; } @endphp >BUDDHISM</option>
                              <option value="OTHER" @php if ($datas->religion == 'OTHER') { echo 'selected'; } @endphp >OTHER</option>
                          </select>
                          <span id="errorReligion" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="marital_status">MARITAL STATUS <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="marital_status" name="marital_status" required>
                              <option value="" style="display:none;">CHOOSE MARITAL STATUS</option>
                              <option value="SINGLE" @php if ($datas->marital_status == 'SINGLE') { echo 'selected'; } @endphp >SINGLE</option>
                              <option value="MARRIED" @php if ($datas->marital_status == 'MARRIED') { echo 'selected'; } @endphp >MARRIED</option>
                              <option value="DIVORCED" @php if ($datas->marital_status == 'DIVORCED') { echo 'selected'; } @endphp >DIVORCED</option>
                              <option value="WIDOW" @php if ($datas->marital_status == 'WIDOW') { echo 'selected'; } @endphp >WIDOW</option>
                              <option value="WIDOWER" @php if ($datas->marital_status == 'WIDOWER') { echo 'selected'; } @endphp >WIDOWER</option>
                          </select>
                          <span id="errorMaritalStatus" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="education_level">EDUCATION LEVEL <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="education_level" name="education_level" required>
                              <option value="" style="display:none;">CHOOSE EDUCATION LEVEL</option>
                              <option value="SD" @php if ($datas->education_level == 'SD') { echo 'selected'; } @endphp >SD</option>
                              <option value="SMP" @php if ($datas->education_level == 'SMP') { echo 'selected'; } @endphp >SMP</option>
                              <option value="SMA/SMK" @php if ($datas->education_level == 'SMA/SMK') { echo 'selected'; } @endphp >SMA/SMK</option>
                              <option value="DIPLOMA 1" @php if ($datas->education_level == 'DIPLOMA 1') { echo 'selected'; } @endphp >DIPLOMA 1</option>
                              <option value="DIPLOMA 2" @php if ($datas->education_level == 'DIPLOMA 2') { echo 'selected'; } @endphp >DIPLOMA 2</option>
                              <option value="DIPLOMA 3" @php if ($datas->education_level == 'DIPLOMA 3') { echo 'selected'; } @endphp >DIPLOMA 3</option>
                              <option value="DIPLOMA 4" @php if ($datas->education_level == 'DIPLOMA 4') { echo 'selected'; } @endphp >DIPLOMA 4</option>
                              <option value="STRATA 1" @php if ($datas->education_level == 'STRATA 1') { echo 'selected'; } @endphp >STRATA 1</option>
                              <option value="STRATA 2" @php if ($datas->education_level == 'STRATA 2') { echo 'selected'; } @endphp >STRATA 2</option>
                              <option value="STRATA 3" @php if ($datas->education_level == 'STRATA 3') { echo 'selected'; } @endphp >STRATA 3</option>
                          </select>
                          <span id="errorEducationLevel" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="role">ROLE SYSTEM <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="role" name="role" required>
                              <option value="" style="display:none;">CHOOSE ROLE SYSTEM</option>
                              <option value="0" @php if ($datas->role == '0') { echo 'selected'; } @endphp >SUPER ADMIN</option>
                              <option value="1" @php if ($datas->role == '1') { echo 'selected'; } @endphp >ADMIN</option>
                              <option value="2" @php if ($datas->role == '2') { echo 'selected'; } @endphp >MEMBER</option>
                              <option value="3" @php if ($datas->role == '3') { echo 'selected'; } @endphp >REPORT</option>
                          </select>
                          <span id="errorRole" class="text-red"></span>
                        </div>
                      </div>

                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Employee Status -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Employee Status</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="join_date">JOIN DATE <span style="color: red;">*</span></label>
                          <div class="input-group datepicker" data-target-input="nearest" data-toggle="datetimepicker">
                            <input type="text" name="join_date" id="join_date" class="form-control" placeholder="DD/Month/YYYY" value="{{$datas->join_date}}" readonly required>
                            <div class="input-group-append" >
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <span id="errorJoinDate" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="employment_status">EMPLOYMENT STATUS <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="employment_status" name="employment_status" required>
                            <option value="" style="display:none;">CHOOSE EMPLOYMENT STATUS</option>
                            @foreach ($emp_stats as $emp_stat)
                            <option value="{{$emp_stat->id}}" @php if ($datas->employment_status == $emp_stat->id) { echo 'selected'; } @endphp >
                              {{$emp_stat->status_name}}
                            </option>
                            @endforeach
                        </select>
                          <span id="errorDepartment" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="start_date">EMPLOYMENT START DATE <span style="color: red;">*</span></label>
                          <div class="input-group datepicker" data-target-input="nearest" data-toggle="datetimepicker">
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="DD/Month/YYYY" value="{{$datas->start_date}}" readonly required>
                            <div class="input-group-append" >
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <span id="errorStartDate" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="Jabatan">EMPLOYEE POSITION <span style="color: red;">*</span></label>
                          <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{$datas->jabatan}}" required>
                          <span id="errorJabatan" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="job_title">JOB TITLE <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="job_title" name="job_title" required>
                              <option value="" style="display:none;">CHOOSE JOB TITLE</option>
                              <option value="DIRECT WORKER" @php if ($datas->job_title == 'DIRECT WORKER') { echo 'selected'; } @endphp >DIRECT WORKER</option>
                              <option value="NON DIRECT WORKER" @php if ($datas->job_title == 'NON DIRECT WORKER') { echo 'selected'; } @endphp>NON DIRECT WORKER</option>
                          </select>
                          <span id="errorJobTitle" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="organization_unit">ORGANIZATION UNIT <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="organization_unit" name="organization_unit" required>
                              <option value="" style="display:none;">CHOOSE ORGANIZATION UNIT</option>
                              <option value="OPERATIONAL" @php if ($datas->organization_unit == 'OPERATIONAL') { echo 'selected'; } @endphp >OPERATIONAL</option>
                              <option value="CORPORATE" @php if ($datas->organization_unit == 'CORPORATE') { echo 'selected'; } @endphp >CORPORATE</option>
                          </select>
                          <span id="errorOrganizationUnit" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="job_status">JOB STATUS <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="job_status" name="job_status" required>
                              <option value="" style="display:none;">CHOOSE JOB STATUS</option>
                              <option value="ACTIVE" @php if ($datas->job_status == 'ACTIVE') { echo 'selected'; } @endphp >ACTIVE</option>
                              <option value="INACTIVE" @php if ($datas->job_status == 'INACTIVE') { echo 'selected'; } @endphp >INACTIVE</option>
                          </select>
                          <span id="errorJobStatus" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="employee_status">EMPLOYEE STATUS <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="employee_status" name="employee_status" required>
                              <option value="" style="display:none;">CHOOSE EMPLOYEE STATUS</option>
                              <option value="ACTIVE" @php if ($datas->employee_status == 'ACTIVE') { echo 'selected'; } @endphp >ACTIVE</option>
                              <option value="INACTIVE" @php if ($datas->employee_status == 'INACTIVE') { echo 'selected'; } @endphp >INACTIVE</option>
                          </select>
                          <span id="errorJobStatus" class="text-red"></span>
                        </div>
                      </div>

                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Employee Structure -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Employee Structure</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="direct_supervisor">DIRECT SUPERVISOR</label>
                          <select class="form-control select2" id="direct_supervisor" name="direct_supervisor">
                              <option value="" style="display:none;">CHOOSE DIRECT SUPERVISOR</option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}" @php if ($datas->direct_supervisor == $user->id) { echo 'selected'; } @endphp >
                                {{$user->fullname}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorDirectSupervisor" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="department">DEPARTMENT <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="department" name="department" required>
                              <option value="" style="display:none;">CHOOSE DEPARTMENT</option>
                              @foreach ($departments as $department)
                              <option value="{{$department->id}}" @php if ($datas->department == $department->id) { echo 'selected'; } @endphp >
                                {{$department->dep_name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorDepartment" class="text-red"></span>
                        </div>
                      </div>

                      <!--  -->

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="immediate_manager">IMMEDIATE MANAGER</label>
                          <select class="form-control select2" id="immediate_manager" name="immediate_manager">
                              <option value="" style="display:none;">CHOOSE MANAGER</option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}" @php if ($datas->immediate_manager == $user->id) { echo 'selected'; } @endphp>
                                {{$user->fullname}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorImmediateManager" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="division">DIVISION <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="division" name="division" required>
                              <option value="" style="display:none;">CHOOSE DIVISION</option>
                              @foreach ($divisions as $division)
                              <option value="{{$division->id}}" @php if ($datas->division == $division->id) { echo 'selected'; } @endphp>
                                {{$division->div_name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorDivision" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="level">LEVEL <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="level" name="level" required>
                              <option value="" style="display:none;">CHOOSE LEVEL</option>
                              @foreach ($levels as $level)
                              <option value="{{$level->id}}" @php if ($datas->level == $level->id) { echo 'selected'; } @endphp >
                                {{$level->lev_name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorLevel" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="area">AREA <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="area" name="area">
                            <option value="" style="display: none">CHOOSE AREA</option>
                            @foreach ($provinces as $id => $name)
                              <option value="{{$id}}" @php if ($datas->area == $id) { echo 'selected'; } @endphp>
                                {{$name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorArea" class="text-red"></span>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="grade_category">GRADE CATEGORY <span style="color: red;">*</span></label>
                          <select class="form-control select2" id="grade_category" name="grade_category" required>
                              <option value="" style="display:none;">CHOOSE GRADE CATEGORY</option>
                              @foreach ($grades as $grade)
                              <option value="{{$grade->id}}" @php if ($datas->grade_category == $grade->id) { echo 'selected'; } @endphp >
                                {{$grade->grade_name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorGradeCategory" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="kota">CITY <span style="color: red;">*</span></label>
                          <select class="form-control select2" name="kota" id="kota">
                            <option value="" style="display: none">CHOOSE CITIES</option>
                            @foreach ($cities as $key => $value)
                              <option value="{{$value->id}}" @php if ($datas->kota == $value->id) { echo 'selected'; } @endphp>
                                {{$value->name}}
                              </option>
                              @endforeach
                          </select>
                          <span id="errorCity" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="work_location">WORK LOCATION <span style="color: red;">*</span></label>
                          <input type="text" name="work_location" id="work_location" class="form-control" value="{{$datas->work_location}}" required>
                          <span id="errorWork_Location" class="text-red"></span>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Employee Terminate -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Employee Terminate</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="end_date">EMPLOYMENT END DATE</label>
                          <div class="input-group datepicker" data-target-input="nearest" data-toggle="datetimepicker">
                            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="DD/Month/YYYY" value="{{$datas->end_date}}" readonly>
                            <div class="input-group-append" >
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <span id="errorEndDate" class="text-red"></span>
                        </div>
                        <div class="form-group">
                          <label for="termination_date">TERMINATION DATE</label>
                          <div class="input-group datepicker" data-target-input="nearest" data-toggle="datetimepicker">
                            <input type="text" name="termination_date" id="termination_date" class="form-control" placeholder="DD/Month/YYYY" value="{{$datas->termination_date}}" readonly>
                            <div class="input-group-append" >
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <span id="errorTerminationDate" class="text-red"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="terminate_reason">TERMINATE REASON</label>
                          <input type="text" name="terminate_reason" id="terminate_reason" class="form-control" value="{{$datas->terminate_reason}}">
                          <span id="errorTerminateReason" class="text-red"></span>
                        </div>

                        <div class="form-group">
                          <label for="resignation">RESIGNATION</label>
                          <div class="custom-file">
                            <input type="file" name="resignation" class="custom-file-input" id="resignation">
                            <label class="custom-file-label label-resignation" for="resignation">Choose File</label>
                          </div>
                          @if (isset($datas->resignation))
                          <a href="{{asset('/assets/resignation').'/'.$datas->resignation}}" target="_blank"><span class="text-info">View File</span></a>
                          @endif
                        </div>
                      </div>

                      <input type="hidden" value="" name="function" id="function" class="form-control">

                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Button -->
                <div class="card card-default">
                  <div class="card-body">
                    <button type="submit" id="submit" class="btn btn-md btn-primary">SIMPAN</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
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

    $(document).on('change', "input[name=resignation]", function (e) {
      // let fileName = $(this).val().split('\\').pop();
      let fileName = $(this).val().replace(/.*(\/|\\)/, '');
      $('.label-resignation').text(fileName);
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

    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });

    //Date picker
    $('.datepicker').datetimepicker({
        format: 'DD/MMMM/YYYY'
    });

    var site_url = "{{ url('/') }}";
    $('#area').on('change', function () {
        var idProvince = this.value;
        $("#kota").html('');

        jQuery.ajax({
            method: "post",
            url: site_url + "/api/fetch-cities",
            data: {
                province_code: idProvince,
                _token: '{{csrf_token()}}'
            },
            beforeSend: function() {
            },
            success:function(result){
                $('#kota option').remove();
                $('#kota').html('<option value="">CHOOSE CITIES</option>');
                $.each(result, function( key, value ) {
                    let val = value.id;
                    $("#kota").append('<option value="' + val + '">' + value.name + '</option>');
                });
            }
        });
    });

    $('#form-edit').submit(function(e){
        e.preventDefault();

        // check file extension
        fileName = document.querySelector('#resignation').value;
        regex = new RegExp('[^.]+$');
        extension = fileName.match(regex);

        if (fileName != '') {
          if (extension[0] == 'pdf' || extension[0] == 'jpg' || extension[0] == 'png') {
            // do nothing
          }
          else {
            alert('Extension File Must .pdf or .jpg or .png');
            return false;
          }
        }

        var formData = new FormData(this);
        $.ajax({
            url:"{{route('dashboard.users.update')}}",
            type:'POST',
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            beforeSend: function() {
              $('button').prop('disabled',true);
              $('#loader').modal ('show');
            },
            success:function(data){
                alert(data.message);
                location.href = data.url;
            },
            error:function(response){
                alert(response);
                location.reload();
            }
        })
    })

    $(document).on('keyup', "input[type=number]", function (e) {
      e.preventDefault;
      let check = /^\d+$/.test($(this).val());
      if (!check) { $(this).val(''); alert('Input must be a number'); }
    });
});
</script>
@endsection