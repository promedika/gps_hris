<?php

namespace App\Imports;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, WithMultipleSheets 
{
    public function sheets(): array
    {
        return [
            'Template' => $this,
        ];
    }
    
    /**
    * 
    */
    public function model(array $row)
    {
        $user = new user();

        $user->fullname = $row['fullname'];
        $user->nik = $row['nik'];
        $user->phone = $row['phone'];
        $user->birth_date = date('Y-m-d', strtotime($row['birth_date']));
        $user->gender = $row['gender'];
        $user->religion = $row['religion'];
        $user->marital_status = $row['marital_status'];
        $user->education_level = $row['education_level'];
        $user->join_date = date('Y-m-d', strtotime($row['join_date']));
        $user->employment_status = $row['employment_status'];
        $user->start_date = date('Y-m-d', strtotime($row['employment_start_date']));
        $user->jabatan = $row['employee_position'];
        $user->job_title = $row['job_title'];
        $user->organization_unit = $row['organization_unit'];
        $user->job_status = $row['job_status'];
        $user->employee_status = $row['employee_status'];
        $user->department = $row['department'];
        $user->division = $row['division'];
        $user->level = $row['level'];
        $user->grade_category = $row['grade_category'];
        $user->work_location = $row['work_location'];
        $user->area = $row['area'];
        $user->kota = $row['kota'];

        $user->created_by = Auth::User()->id;
        $user->updated_by = Auth::User()->id;

        $user->password = Hash::make('promedika');
        $user->role = 2;

        $los_firstDate = date_create(date('Y-m-d',strtotime($user->start_date)));
        $los_endDate = date_create(date('Y-m-d'));

        $los_difDate = date_diff($los_firstDate,$los_endDate);

        $user_los_difDate = $los_difDate->y.' Year '.$los_difDate->m.' Month '.$los_difDate->d.' Day';

        $user->length_of_service = $user_los_difDate;

        $user->save();
    }

    public Function HeadingRow(): int
    {
        return 19;
    }

    public function rules(): array
    {
        return [
            // '*.email' => 'unique:users|email'
        ];
    }
    
}
