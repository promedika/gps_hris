<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\indonesia_cities;

class indonesia_citiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indonesia_cities = indonesia_cities::all();
        return view('indonesia_cities.index', compact('indonesia_cities'));
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
            'name'   => 'required',
        ]);
        $indonesia_cities = new department();
        $indonesia_cities->prov_name = $request->name;
        $indonesia_cities->created_by = Auth::User()->id;
        $indonesia_cities->updated_by = Auth::User()->id;
        $indonesia_cities->save();

        return redirect(route('indonesia_cities.index'));
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
        $indonesia_cities = indonesia_cities::find($id);

        return $indonesia_cities;

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
            'name'=>'required'
        ]);
        $id = $request->id;
        $indonesia_cities = indonesia_cities::find($id);
        $indonesia_cities->prov_name = $request->name;
        $indonesia_cities->updated_by = Auth::User()->id;
        $indonesia_cities->save();
        return redirect(route('indonesia_cities.index'));
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
