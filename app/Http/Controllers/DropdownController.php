<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Redirect;
use App\Models\{Jabatan, Outlet, UserOutlet};
use Laravolt\Indonesia\Models\City;

class DropdownController extends Controller
{
    public function fetchCities(Request $request)
    {   

     $cities = City::where('province_code',$request->province_code)
                ->pluck('name', 'id');
                
                return $cities;
    }
}
