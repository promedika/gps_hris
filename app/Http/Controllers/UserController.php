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
use PhpParser\Node\Stmt\Switch_;
use Laravolt\Indonesia\Models\Province;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->role != 1){
        $users = User::all();
        $emp_stats = EmpStatus::all();
        $jabatans = Jabatan::all();
        $levels = Level::all();
        $grades = GradeCategory::all();
        $divisions = Division::all();
        $departments = Department::all();
        $provinces = Province::pluck('name','code');
        return view('user.index', compact('users','emp_stats','jabatans','levels','grades','divisions','departments','provinces'));
        }else{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $this->validate($request,[
            'fullname'=>'required',
            'nik'=>'required',
            'password'=>'required',
        ]);
        $user = new user();
        $user->nik = $request->nik;
        $user->fullname = $request->fullname;
        $user->birth_date = $request->birth_date;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->religion = $request->religiion;
        $user->marital_status = $request->marital_status;
        $user->education_level = $request->education_level;
        $user->join_date = $request->join_date;
        $user->employment_status = $request->employment_status;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
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
        $user->termination_date = $request->termination_date;
        $user->terminate_reason = $request->terminate_reason;
        $user->resignation = $request->resignation;
        $user->area = $request->area;
        $user->kota = $request->kota;
        $user->division = $request->division;
        $user->department = $request->department;
        $user->function = $request->function;
        $user->created_by = Auth::User()->id;
        $user->updated_by = Auth::User()->id;
        $user->save();

        return redirect(route('dashboard.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
    public function update(Request $request)
    {
        $this->validate($request,[
            'fullname'=>'required',
            'nik'=>'required',
        ]);

        
        $id = $request->id;
        $user = User::find($id);
        $user->nik = $request->nik;
        $user->fullname = $request->fullname;
        if($request->password !='' && strlen(trim($request->password)) > 0){
            $user->password = Hash::make($request->password);
        }
        $user->birth_date = $request->birthdate;
        $user->gender = $request->gender;
        $user->religion = $request->religiion;
        $user->marital_status = $request->marital_status;
        $user->education_level = $request->education_level;
        $user->join_date = $request->join_date;
        $user->employment_status = $request->employment_status;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
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
        $user->termination_date = $request->termination_date;
        $user->terminate_reason = $request->terminate_reason;
        $user->resignation = $request->resignation;
        $user->area = $request->area;
        $user->kota = $request->kota;
        $user->division = $request->division;
        $user->department = $request->department;
        $user->function = $request->function;
        $user->updated_by = Auth::User()->id;
        $user->save();
        return redirect(route('dashboard.users.index'));
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
            Excel::import(new UsersImport,$target_file);
            $return = 'User Berhasil di Import !';
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
