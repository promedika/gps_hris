<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Support\Facades\File;
use App\Models\EmpStatus;
use App\Models\GradeCategory;
use App\Models\Jabatan;
use App\Models\Level;
use App\Models\Division;
use App\Models\Department;
use App\Models\TerminateReason;
use PhpParser\Node\Stmt\Switch_;
use Laravolt\Indonesia\Models\Province;
use App\Models\indonesia_cities;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::User()->role != 1){
            $users = User::all();
            $emp_stats = EmpStatus::all();
            $jabatans = Jabatan::all();
            $levels = Level::all();
            $grades = GradeCategory::all();
            $divisions = Division::all();

            $departments = Department::all();

            $emp_stats_arr = [];
            foreach ($emp_stats as $v) {
                $emp_stats_arr[$v->status_name] = $v->id;
            }
            
            $provinces = Province::pluck('name','code');

            foreach ($users as $k => $v) {
                if ($v->employee_status == 'ACTIVE') {
                    $usr_id = $v->id;
                    $user_los = User::find($usr_id);
                    $user_los->length_of_service = $this->hris_length_of_service($v->start_date);
                    $user_los->save();
                }

                if (is_null($v->employment_status)) continue;
                $v->employment_status = array_search($v->employment_status,$emp_stats_arr);
            }

            return view('user.index', compact('users','emp_stats','jabatans','levels','grades','divisions','departments','provinces'));
        } else {
            return redirect('error.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::User()->role == 0 || Auth::User()->role == 1){
            $users = User::where('employee_status','ACTIVE')->get();
            $emp_stats = EmpStatus::all();
            $jabatans = Jabatan::all();
            $levels = Level::all();
            $grades = GradeCategory::all();
            $divisions = Division::all();
            $departments = Department::all();
            $provinces = Province::pluck('name','code');

            return view('user.create', compact('users','emp_stats','jabatans','levels','grades','divisions','departments','provinces'));
        } else {
            return redirect('error.404');
        }
    }

    public function hris_custom_date($str_date) {
        if (is_null($str_date) || empty($str_date) || !isset($str_date) || $str_date == '') {
            return null;
        }

        $date = explode('/',$str_date);
        $day = $date[0];
        $month = date('m', strtotime($date[1]));
        $year = $date[2];

        $custom_date = $year.'-'.$month.'-'.$day;

        return $custom_date;
    }

    public function hris_length_of_service($start_date) {
        // dd(date('Y-m-d'));
        $firstDate = date_create(date('Y-m-d',strtotime($start_date)));
        $endDate = date_create(date('Y-m-d'));

        $difDate = date_diff($firstDate,$endDate);

        $return = $difDate->y.' Year '.$difDate->m.' Month '.$difDate->d.' Day';
        return $return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'fullname'=>'required',
            'nik'=>'required',
            'phone'=>'required',
            'password'=>'required',
        ]);

        $check_nik = User::where('nik',$request->nik)->get();
        $check_phone = User::where('phone',$request->phone)->get();
    
        if (count($check_nik) > 0 || count($check_phone) > 0) {
            $return['message'] = 'Employee Already Exist!';
            $return['url'] = route('dashboard.user.create');
        }
        else {
            $user = new user();
            
            $user->nik = $request->nik;
            $user->fullname = $request->fullname;
            $user->phone = $request->phone;
            $user->birth_date = $this->hris_custom_date($request->birth_date);
            $user->password = Hash::make($request->password);
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->marital_status = $request->marital_status;
            $user->education_level = $request->education_level;
            $user->role = $request->role;

            $user->join_date = $this->hris_custom_date($request->join_date);
            $user->employment_status = $request->employment_status;
            $user->start_date = $this->hris_custom_date($request->start_date);
            $user->end_date = $this->hris_custom_date($request->end_date);
            $user->jabatan = $request->jabatan;
            $user->organization_unit = $request->organization_unit;
            $user->job_title = $request->job_title;
            $user->job_status = $request->job_status;

            $user->level = $request->level;
            $user->grade_category = $request->grade_category;
            $user->work_location = $request->work_location;
            $user->employee_status = $request->employee_status;
            $user->direct_supervisor = $request->direct_supervisor;
            $user->immediate_manager = $request->immediate_manager;
            $user->termination_date = $this->hris_custom_date($request->termination_date);
            $user->terminate_reason = $request->terminate_reason;
            $user->resignation = $request->resignation;
            $user->area = $request->area;
            $user->kota = $request->kota;
            $user->division = $request->division;
            $user->department = $request->department;

            $user->function = $request->function;

            $user->length_of_service = $this->hris_length_of_service($user->start_date);

            $user->created_by = Auth::User()->id;
            $user->updated_by = Auth::User()->id;

            try {
                $user->save();
                $return['message'] = 'Success';
                $return['url'] = route('dashboard.users.index');
            } catch (Exception $e) {
                // dd($e->getMessage());
                $return['message'] = 'Failed';
            }
        }

        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = DB::table('users')
                ->leftJoin('emp_statuses', 'emp_statuses.id', '=', 'users.employment_status')
                ->leftJoin('levels', 'levels.id', '=', 'users.level')
                ->leftJoin('grade_categories', 'grade_categories.id', '=', 'users.grade_category')
                ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area')
                ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
                ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
                ->leftJoin('departments', 'departments.id', '=', 'users.department')
                ->leftJoin('terminate_reasons', 'terminate_reasons.id', '=', 'users.terminate_reason')
                ->select('users.*','emp_statuses.status_name','levels.level','levels.lev_name','grade_categories.level as grade_level','grade_categories.grade_name','indonesia_provinces.name as provinces','indonesia_cities.name as cities','divisions.div_name','departments.dep_name','terminate_reasons.id as terminate_id','terminate_reasons.name as terminate_name')
                ->where('users.id',$id)
                ->first();

        if (!isset($datas)) {
            return redirect('error.404');
        }

        // custom role name
        $role = 'Super Admin';
        if ($datas->role == 1) {
            $role = 'Admin';
        } else if ($datas->role == 2) {
            $role = 'Member';
        } else if ($datas->role == 3) {
            $role = 'Report';
        }
        $datas->role_name = $role;

        // custom direct_supervisor name
        $direct_supervisor = '-';
        if (!is_null($datas->direct_supervisor)) {
            $direct_supervisor = User::find($datas->direct_supervisor)->fullname;
        }
        $datas->direct_supervisor_name = $direct_supervisor;

        // custom immediate_manager name
        $immediate_manager = '-';
        if (!is_null($datas->immediate_manager)) {
            $immediate_manager = User::find($datas->immediate_manager)->fullname;
        }
        $datas->immediate_manager_name = $immediate_manager;

        return view('user.show', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::User()->role == 0 || Auth::User()->role == 1){
            $datas = DB::table('users')
                    ->leftJoin('emp_statuses', 'emp_statuses.id', '=', 'users.employment_status')
                    ->leftJoin('levels', 'levels.id', '=', 'users.level')
                    ->leftJoin('grade_categories', 'grade_categories.id', '=', 'users.grade_category')
                    ->leftJoin('indonesia_provinces', 'indonesia_provinces.code', '=', 'users.area')
                    ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
                    ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
                    ->leftJoin('departments', 'departments.id', '=', 'users.department')
                    ->leftJoin('terminate_reasons', 'terminate_reasons.id', '=', 'users.terminate_reason')
                    ->select('users.*','emp_statuses.status_name','levels.level as lev_level','levels.lev_name','grade_categories.level as grade_level','grade_categories.grade_name','indonesia_provinces.name as provinces','indonesia_cities.name as cities','divisions.div_name','departments.dep_name','terminate_reasons.id as terminate_id','terminate_reasons.name as terminate_name')
                    ->where('users.id',$id)
                    ->first();

            if (!isset($datas)) {
                return redirect('error.404');
            }

            // custom direct_supervisor name
            $direct_supervisor = '-';
            if (!is_null($datas->direct_supervisor)) {
                $direct_supervisor = User::find($datas->direct_supervisor)->fullname;
            }
            $datas->direct_supervisor_name = $direct_supervisor;

            // custom immediate_manager name
            $immediate_manager = '-';
            if (!is_null($datas->immediate_manager)) {
                $immediate_manager = User::find($datas->immediate_manager)->fullname;
            }

            $datas->birth_date = date('d/M/Y', strtotime($datas->birth_date));
            $datas->join_date = date('d/M/Y', strtotime($datas->join_date));
            $datas->start_date = date('d/M/Y', strtotime($datas->start_date));

            $datas->end_date = isset($datas->end_date) ? date('d/M/Y', strtotime($datas->end_date)) : '';
            $datas->termination_date = isset($datas->termination_date) ? date('d/M/Y', strtotime($datas->termination_date)) : '';

            $datas->immediate_manager_name = $immediate_manager;

            $users = User::where('users.employee_status','ACTIVE')->get();
            $emp_stats = EmpStatus::all();
            $jabatans = Jabatan::all();
            $levels = Level::all();
            $grades = GradeCategory::all();
            $divisions = Division::all();
            $departments = Department::all();
            $terminate_reasons = TerminateReason::all();
            $provinces = Province::pluck('name','code');
            $cities = indonesia_cities::where('province_code', $datas->area)->get();

            return view('user.edit', compact('users','emp_stats','jabatans','levels','grades','divisions','departments','provinces','datas','cities','terminate_reasons'));
        } else {
            return redirect('error.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'fullname'=>'required',
            'nik'=>'required',
            'phone'=>'required',
        ]);
        
        $id = $request->id;
        $user = User::find($id);

        if($request->password !='' && strlen(trim($request->password)) > 0){
            $user->password = Hash::make($request->password);
        }

        $user->nik = $request->nik;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->birth_date = $this->hris_custom_date($request->birth_date);
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->marital_status = $request->marital_status;
        $user->education_level = $request->education_level;
        $user->role = $request->role;

        $user->join_date = $this->hris_custom_date($request->join_date);
        $user->employment_status = $request->employment_status;
        $user->start_date = $this->hris_custom_date($request->start_date);
        
        $user->jabatan = $request->jabatan;
        $user->organization_unit = $request->organization_unit;
        $user->job_title = $request->job_title;
        $user->job_status = $request->job_status;

        $user->level = $request->level;
        $user->grade_category = $request->grade_category;
        $user->work_location = $request->work_location;
        $user->employee_status = $request->employee_status;
        $user->direct_supervisor = $request->direct_supervisor;
        $user->immediate_manager = $request->immediate_manager;
        
        $user->area = $request->area;
        $user->kota = $request->kota;
        $user->division = $request->division;
        $user->department = $request->department;

        $user->function = $request->function;

        $user->length_of_service = $this->hris_length_of_service($user->start_date);

        $user->updated_by = Auth::User()->id;

        if (isset($request->end_date)) {
            $user->end_date = $this->hris_custom_date($request->end_date);
        }

        if (isset($request->termination_date)) {
            $user->termination_date = $this->hris_custom_date($request->termination_date);
        }

        if (isset($request->terminate_reason)) {
            $user->terminate_reason = $request->terminate_reason;
        }

        if (isset($request->resignation)) {
            $file       = $request->file('resignation');
            $filename    = $user->nik.'_'.time().'_'.$file->hashName();
           
            $tmp_path = $_FILES["resignation"]["tmp_name"];

            // declare full path and filename
            $target_file = public_path('/assets/resignation/');


            // move file upload to storage
            $file->move($target_file, $filename);

            $user->resignation = $filename;
        }

        try {
            $user->save();
            $return['message'] = 'Success';
            $return['url'] = route('dashboard.users.index');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $return['message'] = 'Failed';
        }

        return $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->delete();
        return $user;

        return view('user.index', compact('users'));
    }

    public function editPassword(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        return response()->json(['data' => $user]);
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if($request->password !='' && strlen(trim($request->password)) > 0){
            $user->password = Hash::make($request->password);
        }
        $user->updated_by = Auth::User()->id;
        $user->save();
        return redirect(route('dashboard.users.index'));
    }

    public function uploadUsers(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();

        $ext = ['xlsx','xls'];

        if (!in_array($extension,$ext)){

            return redirect()->route('.dashboard.users.index')->with('message', 'Format file tidak sesuai !');
        }

        $tmp_path = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
        $target_file = storage_path('app'.DIRECTORY_SEPARATOR.$filename);

        // move file upload to storage
        move_uploaded_file($tmp_path, $target_file);
        try {
            $import = new UsersImport();
            $import_data = Excel::import($import, $target_file);
            
            $return = 'Success';
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            foreach ($failures as $failure) {
                $return = $failure->errors();
            }
            File::delete($target_file);
            
            return redirect()->route('dashboard.users.index')->with('failure', $return[0]);
        }
        File::delete($target_file);
        return redirect()->route('dashboard.users.index')->with('success', $return);
    }
}
