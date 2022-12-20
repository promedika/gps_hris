<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Indonesia_province;

class Indonesia_provinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indonesia_provinces = Indonesia_province::all();
        return view('indonesia_province.index', compact('indonesia_provinces'));
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
        $indonesia_province = new Indonesia_province();
        $indonesia_province->id = $request->id;
        $indonesia_province->code = $request->code;
        $indonesia_province->name = $request->name;
        $indonesia_province->meta = $request->meta;
        $indonesia_province->created_by = Auth::User()->id;
        $indonesia_province->updated_by = Auth::User()->id;
        $indonesia_province->save();

        return redirect(route('indonesia_province.index'));
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
        $indonesia_province = Indonesia_province::find($id);

        return $indonesia_province;

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
        $indonesia_province = Indonesia_province::find($id);
        $indonesia_province->name = $request->name;
        $indonesia_province->updated_by = Auth::User()->id;
        $indonesia_province->save();
        return redirect(route('indonesia_province.index'));
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
        $indonesia_province = Indonesia_province::find($id);
        $indonesia_province->delete();
        return redirect(route('indonesia_province.index'));
    }
}
