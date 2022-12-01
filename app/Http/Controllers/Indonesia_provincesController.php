<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\indonesia_provinces;

class indonesia_provincesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indonesia_provinces = indonesia_provinces::all();
        return view('indonesia_provinces.index', compact('indonesia_provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
            'id'  =>'required',
            'code'=>'required',
            'name'=>'required',
            'meta'=>'required',
        ]);
        $indonesia_provinces = new indonesia_provinces();
        $indonesia_provinces->id = $request->id;
        $indonesia_provinces->code = $request->code;
        $indonesia_provinces->name = $request->name;
        $indonesia_provinces->meta = $request->meta;
        $indonesia_provinces->created_by = Auth::User()->id;
        $indonesia_provinces->updated_by = Auth::User()->id;
        $indonesia_provinces->save();

        return redirect(route('indonesia_provinces.index'));
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
        $indonesia_provinces = indonesia_provinces::find($id);

        return $indonesia_provinces;

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
        $indonesia_provinces = indonesia_provinces::find($id);
        $indonesia_provinces->name = $request->name;
        $indonesia_provinces->updated_by = Auth::User()->id;
        $indonesia_provinces->save();
        return redirect(route('indonesia_provinces.index'));
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
        $indonesia_provinces = indonesia_provinces::find($id);
        $indonesia_provinces->delete();
        return redirect(route('indonesia_provinces.index'));
    }
}
