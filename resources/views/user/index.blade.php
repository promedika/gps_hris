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
                                <td>
                                  <a href="{{route('dashboard.user.show', ['id' => $user->id])}}" user-id="{{$user->id}}" title="view" class="btn btn-info btn-view-user"><i class="fas fa-eye"></i></a>
                                  <a href="#" user-id="{{$user->id}}" title="edit" class="btn btn-warning btn-edit-user"><i class="fas fa-edit"></i></a>
                                  <a href="#" user-id="{{$user->id}}" data-user="{{$user->fullname}}" title="delete" class="btn btn-danger btn-delete-user"><i class="fas fa-trash"></i></a>
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
<div class="modal fade in" id="modalCreateUser" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" method="post" accept-charset="utf-8" id="form-signup">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">CREATE NEW EMPLOYEE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="nik">EMPLOYEE NO</label>
          <input type="text" name="nik" id="nik" class="form-control"required>
          <span id="errorNik" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="fullname">EMPLOYEE NAME</label>
          <input type="text" name="fullname" id="fullname" class="form-control" required>
          <span id="errorFullName" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="birth_date">BIRTH DATE</label>
          <input type="date" name="birth_date" id="birth_date" class="form-control"required>
          <span id="errorBirthDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="password">PASSWORD</label>
          <input type="password" name="password" id="password" class="form-control"required>
          <span id="errorPassword" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="gender">GENDER</label>
          <select class="form-control" id="gender" name="gender"required>
              <option value="" style="display:none;">CHOOSE GENDER</option>
              <option value="MEN">MEN</option>
              <option value="WOMEN">WOMEN</option>
          </select>
          <span id="errorGender" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="religion">RELIGION</label>
          <select class="form-control" id="religion" name="religion"required>
              <option value="" style="display:none;">CHOOSE RELIGION</option>
              <option value="ISLAM">ISLAM</option>
              <option value="CHRISTIAN">CHRISTIAN</option>
              <option value="CATHOLIC">CATHOLIC</option>
              <option value="HINDUISM">HINDUISM</option>
              <option value="BUDDHISM">BUDDHISM</option>
              <option value="OTHER">OTHER</option>
          </select>
          <span id="errorReligion" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="marital_status">MARITAL STATUS</label>
          <select class="form-control" id="marital_status" name="marital_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="SINGLE">SINGLE</option>
              <option value="MARRIED">MARRIED</option>
              <option value="DIVORCED">DIVORCED</option>
              <option value="WIDOW">WIDOW</option>
              <option value="WIDOWER">WIDOWER</option>
          </select>
          <span id="errorMaritalStatus" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="education_level">EDUCATION LEVEL</label>
          <select class="form-control" id="education_level" name="education_level"required>
              <option value="" style="display:none;">CHOOSE LEVEL</option>
              <option value="SD">SD</option>
              <option value="SMP">SMP</option>
              <option value="SMA/SMK">SMA/SMK</option>
              <option value="DIPLOMA 1">DIPLOMA 1</option>
              <option value="DIPLOMA 2">DIPLOMA 2</option>
              <option value="DIPLOMA 3">DIPLOMA 3</option>
              <option value="DIPLOMA 4">DIPLOMA 4</option>
              <option value="STRATA 1">STRATA 1</option>
              <option value="STRATA 2">STRATA 2</option>
              <option value="STRATA 3">STRATA 3</option>
          </select>
          <span id="errorEducationLevel" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="join_date">JOIN DATE</label>
          <input type="date" name="join_date" id="join_date" class="form-control"required>
          <span id="errorJoinDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="employment_status">EMPLOYMENT STATUS</label>
          <select class="form-control" id="employment_status" name="employment_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="KARYAWAN TETAP">KARYAWAN TETAP</option>
              <option value="KARYAWAN KONTRAK">KARYAWAN KONTRAK</option>
              <option value="PROBATION">PROBATION</option>
          </select>
          <span id="errorDepartment" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="start_date">EMPLOYMENT START DATE</label>
          <input type="date" name="start_date" id="start_date" class="form-control"required>
          <span id="errorStartDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="end_date">EMPLOYMENT END DATE</label>
          <input type="date" name="end_date" id="end_date" class="form-control"required>
          <span id="errorEndDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="Jabatan">EMPLOYEE POSITION</label>
          <select class="form-control" id="jabatan" name="jabatan"required>
              <option value="" style="display:none;">CHOOSE POSITION</option>
              @foreach ($jabatans as $jabatan)
              <option value="{{$jabatan->id}}">
                {{$jabatan->jab_name}}
              </option>
              @endforeach
          </select>
          <span id="errorJabatan" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="organization_unit">ORGANIZATION UNIT</label>
          <select class="form-control" id="organization_unit" name="organization_unit"required>
              <option value="" style="display:none;">CHOOSE UNIT</option>
              <option value="OPERATIONAL">OPERATIONAL</option>
              <option value="CORPORATE">CORPORATE</option>
          </select>
          <span id="errorOrganizationUnit" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="job_title">JOB TITLE</label>
          <select class="form-control" id="job_title" name="job_title"required>
              <option value="" style="display:none;">CHOOSE TITLE</option>
              <option value="DIRECT WORKER">DIRECT WORKER</option>
              <option value="NON DIRECT WORKER">NON DIRECT WORKER</option>
          </select>
          <span id="errorJobTitle" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="job_status">JOB STATUS</label>
          <select class="form-control" id="job_status" name="job_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="ACTIVE">ACTIVE</option>
              <option value="INACTIVE">INACTIVE</option>
          </select>
          <span id="errorJobStatus" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="level">LEVEL</label>
          <select class="form-control" id="level" name="level"required>
              <option value="" style="display:none;">CHOOSE LEVEL</option>
              @foreach ($levels as $level)
              <option value="{{$level->id}}">
                {{$level->lev_name}}
              </option>
              @endforeach
          </select>
          <span id="errorLevel" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="grade_category">GRADE CATEGORY</label>
          <select class="form-control" id="grade_category" name="grade_category"required>
              <option value="" style="display:none;">CHOOSE CATEGORY</option>
              @foreach ($grades as $grade)
              <option value="{{$grade->id}}">
                {{$grade->grade_name}}
              </option>
              @endforeach
          </select>
          <span id="errorGradeCategory" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="work_location">WORK LOCATION</label>
          <input type="text" name="work_location" id="work_location" class="form-control"required>
          <span id="errorWork_Location" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="employee_status">EMPLOYEE STATUS</label>
          <select class="form-control" id="employee_status" name="employee_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="ACTIVE">ACTIVE</option>
              <option value="INACTIVE">INACTIVE</option>
          </select>
          <span id="errorJobStatus" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="direct_supervisor">DIRECT SUPERVISOR</label>
          <select class="form-control" id="direct_supervisor" name="direct_supervisor"required>
              <option value="" style="display:none;">CHOOSE SUPERVISOR</option>
              @foreach ($users as $user)
              <option value="{{$user->id}}">
                {{$user->fullname}}
              </option>
              @endforeach
          </select>
          <span id="errorDirectSupervisor" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="immediate_manager">IMMEDIATE MANAGER</label>
          <select class="form-control" id="immediate_manager" name="immediate_manager"required>
              <option value="" style="display:none;">CHOOSE MANAGER</option>
              @foreach ($users as $user)
              <option value="{{$user->id}}">
                {{$user->fullname}}
              </option>
              @endforeach
          </select>
          <span id="errorImmediateManager" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="termination_date">TERMINATION DATE</label>
          <input type="date" name="termination_date" id="termination_date" class="form-control"required>
          <span id="errorTerminationDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="terminate_reason">TERMINATE REASON</label>
          <input type="text" name="terminate_reason" id="terminate_reason" class="form-control" required>
          <span id="errorTerminateReason" class="text-red"></span>
        </div>
        <div>
          <label for="resignation">RESIGNATION</label>
          <input type="file" name="resignation" id="resignation" class="form-control">
          <span id="errorResignation" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="area">AREA</label>
          <select class="form-control" id="area" name="area">
            <option value="" style="display: none">CHOOSE AREA</option>
            @foreach ($provinces as $id => $name)
              <option value="{{$id}}">
                {{$name}}
              </option>
              @endforeach
          </select>
          <span id="errorArea" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="kota">CITY</label>
          <select name="kota" id="kota" class="form-control">
            <option value="">CHOOSE CITIES</option>
          <span id="errorCity" class="text-red"></span>
          </select>
        </div>
        <div class="form-group">
          <label for="division">DIVISION</label>
          <select class="form-control" id="division" name="division"required>
              <option value="" style="display:none;">CHOOSE DIVISION</option>
              @foreach ($divisions as $division)
              <option value="{{$division->id}}">
                {{$division->div_name}}
              </option>
              @endforeach
          </select>
          <span id="errorDivision" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="department">DEPARTMENT</label>
          <select class="form-control" id="department" name="department"required>
              <option value="" style="display:none;">CHOOSE DEPARTMENT</option>
              @foreach ($departments as $department)
              <option value="{{$department->id}}">
                {{$department->dep_name}}
              </option>
              @endforeach
          </select>
          <span id="errorDepartment" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="function">FUNCTION</label>
          <input type="text" name="function" id="function" class="form-control" required>
          <span id="errorFunction" class="text-red"></span>
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


<!-- The Modal -->
<div class="modal fade in" id="modalEditUser" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">EDIT EMPLOYEE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="nik">EMPLOYEE NO</label>
          <input type="text" name="nik" id="nik_update" class="form-control"required>
          <span id="errorNik" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="fullname">EMPLOYEE NAME</label>
          <input type="text" name="fullname" id="fullname_update" class="form-control" required>
          <span id="errorFullName" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="birth_date">BIRTH DATE</label>
          <input type="date" name="birth_date" id="birth_date_update" class="form-control"required>
          <span id="errorBirthDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="password">PASSWORD</label>
          <input type="password" name="password" id="password_update" class="form-control"required>
          <span id="errorPassword" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="gender">GENDER</label>
          <select class="form-control" id="gender_update" name="gender_update"required>
              <option value="" style="display:none;">CHOOSE GENDER</option>
              <option value="MEN">MEN</option>
              <option value="WOMEN">WOMEN</option>
          </select>
          <span id="errorGender" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="religion">RELIGION</label>
          <select class="form-control" id="religion_update" name="religion"required>
              <option value="" style="display:none;">CHOOSE RELIGION</option>
              <option value="ISLAM">ISLAM</option>
              <option value="CHRISTIAN">CHRISTIAN</option>
              <option value="CATHOLIC">CATHOLIC</option>
              <option value="HINDUISM">HINDUISM</option>
              <option value="BUDDHISM">BUDDHISM</option>
              <option value="OTHER">OTHER</option>
          </select>
          <span id="errorReligion" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="marital_status">MARITAL STATUS</label>
          <select class="form-control" id="marital_status_update" name="marital_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="SINGLE">SINGLE</option>
              <option value="MARRIED">MARRIED</option>
              <option value="DIVORCED">DIVORCED</option>
              <option value="WIDOW">WIDOW</option>
              <option value="WIDOWER">WIDOWER</option>
          </select>
          <span id="errorMaritalStatus" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="education_level">EDUCATION LEVEL</label>
          <select class="form-control" id="education_level_update" name="education_level"required>
              <option value="" style="display:none;">CHOOSE LEVEL</option>
              <option value="SD">SD</option>
              <option value="SMP">SMP</option>
              <option value="SMA/SMK">SMA/SMK</option>
              <option value="DIPLOMA 1">DIPLOMA 1</option>
              <option value="DIPLOMA 2">DIPLOMA 2</option>
              <option value="DIPLOMA 3">DIPLOMA 3</option>
              <option value="DIPLOMA 4">DIPLOMA 4</option>
              <option value="STRATA 1">STRATA 1</option>
              <option value="STRATA 2">STRATA 2</option>
              <option value="STRATA 3">STRATA 3</option>
          </select>
          <span id="errorEducationLevel" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="join_date">JOIN DATE</label>
          <input type="date" name="join_date" id="join_date_update" class="form-control"required>
          <span id="errorJoinDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="employment_status">EMPLOYMENT STATUS</label>
          <select class="form-control" id="employment_status_update" name="employment_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              @foreach ($emp_stats as $emp_stat)
              <option value="{{$emp_stat->id}}">
                {{$emp_stat->emp_stat_name}}
              </option>
              @endforeach
          </select>
          <span id="errorDepartment" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="start_date">EMPLOYMENT START DATE</label>
          <input type="date" name="start_date" id="start_date_update" class="form-control"required>
          <span id="errorStartDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="end_date">EMPLOYMENT END DATE</label>
          <input type="date" name="end_date" id="end_date_update" class="form-control"required>
          <span id="errorEndDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="Jabatan">EMPLOYEE POSITION</label>
          <select class="form-control" id="jabatan_update" name="jabatan"required>
              <option value="" style="display:none;">CHOOSE POSITION</option>
              @foreach ($jabatans as $jabatan)
              <option value="{{$jabatan->id}}">
                {{$jabatan->jab_name}}
              </option>
              @endforeach
          </select>
          <span id="errorJabatan" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="organization_unit">ORGANIZATION UNIT</label>
          <select class="form-control" id="organization_unit_update" name="organization_unit"required>
              <option value="" style="display:none;">CHOOSE UNIT</option>
              <option value="OPERATIONAL">OPERATIONAL</option>
              <option value="CORPORATE">CORPORATE</option>
          </select>
          <span id="errorOrganizationUnit" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="job_title">JOB TITLE</label>
          <select class="form-control" id="job_title_update" name="job_title"required>
              <option value="" style="display:none;">CHOOSE TITLE</option>
              <option value="DIRECT WORKER">DIRECT WORKER</option>
              <option value="NON DIRECT WORKER">NON DIRECT WORKER</option>
          </select>
          <span id="errorJobTitle" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="job_status">JOB STATUS</label>
          <select class="form-control" id="job_status_update" name="job_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="ACTIVE">ACTIVE</option>
              <option value="INACTIVE">INACTIVE</option>
          </select>
          <span id="errorJobStatus" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="level">LEVEL</label>
          <select class="form-control" id="level_update" name="level"required>
              <option value="" style="display:none;">CHOOSE LEVEL</option>
              @foreach ($levels as $level)
              <option value="{{$level->id}}">
                {{$level->lev_name}}
              </option>
              @endforeach
          </select>
          <span id="errorLevel" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="grade_category">GRADE CATEGORY</label>
          <select class="form-control" id="grade_category_update" name="grade_category"required>
              <option value="" style="display:none;">CHOOSE CATEGORY</option>
              @foreach ($grades as $grade)
              <option value="{{$grade->id}}">
                {{$grade->grade_name}}
              </option>
              @endforeach
          </select>
          <span id="errorGradeCategory" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="work_location">WORK LOCATION</label>
          <input type="text" name="work_location_update" id="work_location_update" class="form-control"required>
          <span id="errorWork_Location" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="employee_status">EMPLOYEE STATUS</label>
          <select class="form-control" id="employee_status_update" name="employee_status"required>
              <option value="" style="display:none;">CHOOSE STATUS</option>
              <option value="ACTIVE">ACTIVE</option>
              <option value="INACTIVE">INACTIVE</option>
          </select>
          <span id="errorJobStatus" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="direct_supervisor">DIRECT SUPERVISOR</label>
          <select class="form-control" id="direct_supervisor_update" name="direct_supervisor"required>
              <option value="" style="display:none;">CHOOSE SUPERVISOR</option>
              @foreach ($users as $user)
              <option value="{{$user->id}}">
                {{$user->fullname}}
              </option>
              @endforeach
          </select>
          <span id="errorDirectSupervisor" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="immediate_manager">IMMEDIATE MANAGER</label>
          <select class="form-control" id="immediate_manager_update" name="immediate_manager"required>
              <option value="" style="display:none;">CHOOSE MANAGER</option>
              @foreach ($users as $user)
              <option value="{{$user->id}}">
                {{$user->fullname}}
              </option>
              @endforeach
          </select>
          <span id="errorImmediateManager" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="termination_date">TERMINATION DATE</label>
          <input type="date" name="termination_date" id="termination_date_update" class="form-control"required>
          <span id="errorTerminationDate" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="terminate_reason">TERMINATE REASON</label>
          <input type="text" name="terminate_reason" id="terminate_reason_update" class="form-control" required>
          <span id="errorTerminateReason" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="resignation">RESIGNATION</label>
          <input type="file" name="resignation" id="resignation_update" class="form-control">
          <span id="errorResignation" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="area">AREA</label>
          <input type="text" name="area" id="area_update" class="form-control"required>
          <span id="errorArea" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="kota">CITY</label>
          <select name="kota" id="kota_update" class="form-control"required>
          <span id="errorCity" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="division">DIVISION</label>
          <select class="form-control" id="division_update" name="division"required>
              <option value="" style="display:none;">CHOOSE DIVISION</option>
              @foreach ($divisions as $division)
              <option value="{{$division->id}}">
                {{$division->div_name}}
              </option>
              @endforeach
          </select>
          <span id="errorDivision" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="department">DEPARTMENT</label>
          <select class="form-control" id="department_update" name="department"required>
              <option value="" style="display:none;">CHOOSE DEPARTMENT</option>
              @foreach ($departments as $department)
              <option value="{{$department->id}}">
                {{$department->dep_name}}
              </option>
              @endforeach
          </select>
          <span id="errorDepartment" class="text-red"></span>
        </div>
        <div class="form-group">
          <label for="function">FUNCTION</label>
          <input type="text" name="function" id="function_update" class="form-control" required>
          <span id="errorFunction" class="text-red"></span>
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

        jQuery("body").on("click", ".btn-edit-user", function(e) {
            $('#modalEditUser').modal('show');
            var userID = $(this).attr('user-id');
            var id = $('#id').val(userID);
                $.ajax({
                    url:"{{route('dashboard.users.edit')}}",
                    type:'POST',
                    data:{
                      id:userID,
                    },
                    success:function(data){
                        console.log('success edit');
                        $('#nik_update').val(data.data.nik);
                        $('#fullname_update').val(data.data.fullname);
                        $('#birth_date_update').val(data.data.birth_date);
                        $('#password_update').val(data.data.password);
                        $('#gender_update').val(data.data.gender);
                        $('#religion_update').val(data.data.religion);
                        $('#marital_status_update').val(data.data.marital_status);
                        $('#education_level_update').val(data.data.education_level);
                        $('#join_date_update').val(data.data.join_date);
                        $('#employment_status_update').val(data.data.employment_status);
                        $('#start_date_update').val(data.data.start_date);
                        $('#end_date_update').val(data.data.end_date);
                        $('#jabatan_update').val(data.data.jabatan);
                        $('#organization_unit_update').val(data.data.organization_unit);
                        $('#job_title_update').val(data.data.job_title);
                        $('#job_status_update').val(data.data.job_status);
                        $('#level_update').val(data.data.level_update);
                        $('#grade_category_update').val(data.data.grade_category);
                        $('#work_location_update').val(data.data.work_location);
                        $('#employee_status_update').val(data.data.employee_status);
                        $('#direct_supervisor_update').val(data.data.direct_supervisor);
                        $('#immediate_manager_update').val(data.data.immediate_manager);
                        $('#termination_date_update').val(data.data.termination_date);
                        $('#status_update').val(data.data.status);
                        $('#terminate_reason_update').val(data.data.terminate_reason);
                        $('#resignation_update').val(data.data.resignation);
                        $('#area_update').val(data.data.area);
                        $('#city_update').val(data.data.city);
                        $('#division_update').val(data.data.division);
                        $('#department_update').val(data.data.department);
                        $('#function_update').val(data.data.function);
                    },
                    error:function(response){
                        $('#errorNik').text(response.responseJSON.errors.nik);
                        $('#errorFullName').text(response.responseJSON.errors.fullname);
                        $('#errorEmail').text(response.responseJSON.errors.email);
                        $('#errorPassword').text(response.responseJSON.errors.password);
                        $('#errorDepartment').text(response.responseJSON.errors.department);
                        $('#errorJabatan').text(response.responseJSON.errors.jabatan);
                        $('#errorStartDate').text(response.responseJSON.errors.start_date);
                        $('#errorEndDate').text(response.responseJSON.errors.end_date);
                    }
                    
                })

                $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEditUser');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('dashboard.users.update')}}",
                    type:'POST',
                    data:formData,
                    data:{
                      id:userID,
                      nik:$('#nik_update').val(),
                      fullname:$('#fullname_update').val(),
                      birth_date:$('#birthdate_update').val(),
                      password:$('#password_update').val(),
                      gender:$('#gender_update').val(),
                      religion:$('#religion_update').val(),
                      marital_status:$('#marital_status_update').val(),
                      education_level:$('#education_level_update').val(),
                      join_date:$('#join_date_update').val(),
                      employment_status:$('#employment_status_update').val(),
                      start_date:$('#start_date_update').val(),
                      end_date:$('#end_date_update').val(),
                      jabatan:$('#jabatan_update').val(),
                      organization_unit:$('#oragnization_unit_update').val(),
                      job_title:$('#job_title_update').val(),
                      job_status:$('#job_status_update').val(),
                      level:$('#level_update').val(),
                      grade_category:$('#grade_category_update').val(),
                      work_location:$('#work_location_update').val(),
                      employee_status:$('#employee_status_update').val(),
                      direct_supervisor:$('#direct_supervisor_update').val(),
                      immediate_manager:$('#immediate_manager_update').val(),
                      termination_date:$('#termination_date_update').val(),
                      terminate_reason:$('#terminate_reason_update').val(),
                      resignation:$('#resignation_update').val(),
                      area:$('#area_update').val(),
                      kota:$('#kota_update').val(),
                      division:$('#division_update').val(),
                      department:$('#department_update').val(),
                      function:$('#function_update').val()
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
                        $('#errorFullName').text(response.responseJSON.errors.fullname);
                        $('#errorNik').text(response.responseJSON.errors.nik);
                        $('#errorLastName').text(response.responseJSON.errors.last_name);
                        $('#errorEmail').text(response.responseJSON.errors.email);
                        $('#errorPassword').text(response.responseJSON.errors.password);
                        $('#errorDepartment').text(response.responseJSON.errors.department);
                        $('#errorJabatan').text(response.responseJSON.errors.jabatan);
                        $('#errorStartDate').text(response.responseJSON.errors.start_date);
                        $('#errorEndDate').text(response.responseJSON.errors.end_date);

                        modal_id.find('.modal-footer button').prop('disabled',false);
                        modal_id.find('.modal-header button').prop('disabled',false);
                    }
                })
            })
        })

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