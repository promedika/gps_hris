<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Redirect;
use App\Models\{Jabatan, Outlet, UserOutlet};
use Laravolt\Indonesia\Models\City;
use DB;

class DropdownController extends Controller
{
    public function fetchCities(Request $request)
    {   

        $cities = DB::table('indonesia_cities')
                    ->where('province_code', $request->province_code)
                    ->get();

        return $cities;
    }
}
