<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\indonesia_cities;
use App\Models\Indonesia_province;

class indonesia_citiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indonesia_provinces = Indonesia_province::all();
        $indonesia_cities = indonesia_cities::all();
        return view('indonesia_cities.index', compact('indonesia_cities','indonesia_provinces'));
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
        $this->validate($request,[
            'province'   => 'required',
            'name'   => 'required',
        ]);

        $last_data = indonesia_cities::where('province_code',$request->province)->latest('id')->first();
        
        $province_code = $last_data->code + 1;
        
        $indonesia_cities = new indonesia_cities();
        $indonesia_cities->code = $province_code;
        $indonesia_cities->province_code = $request->province;
        $indonesia_cities->name = $request->name;
        $indonesia_cities->created_by = Auth::User()->id;
        $indonesia_cities->updated_by = Auth::User()->id;
        
        $return = 'Success';

        try {
            $indonesia_cities->save();
        } catch (Exception $e) {
            $return = 'Failed';
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
        $indonesia_provinces = Indonesia_province::all();
        $indonesia_cities = indonesia_cities::find($id);
        $provinces_edit = Indonesia_province::where('code',$indonesia_cities->province_code)->first('name');

        return response()->json(['cities' => $indonesia_cities, 'provinces' => $indonesia_provinces, 'provinces_edit' => $provinces_edit]);
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
            'id'   => 'required',
            'province'   => 'required',
            'name'   => 'required',
            'old_province_code' => 'required',
        ]);

        $id = $request->id;

        $last_data = indonesia_cities::where('province_code',$request->province)->latest('id')->first();
        
        $province_code = $last_data->code + 1;
        
        $indonesia_cities = indonesia_cities::find($id);;
        if ($request->province != $request->old_province_code) {
            $indonesia_cities->code = $province_code;
        }
        $indonesia_cities->province_code = $request->province;
        $indonesia_cities->name = $request->name;
        $indonesia_cities->updated_by = Auth::User()->id;
        
        $return = 'Success';

        try {
            $indonesia_cities->save();
        } catch (Exception $e) {
            $return = 'Failed';
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
        $indonesia_cities = indonesia_cities::find($id);
        $indonesia_cities->delete();
        return redirect(route('indonesia_cities.index'));
    }
}
