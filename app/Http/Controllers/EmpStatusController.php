<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpStatus;
use Illuminate\Support\Facades\Auth;

class EmpStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = EmpStatus::all();
        return view('emp_status.index', compact('datas'));
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
            'name' => 'required',
        ]);
        $data = new EmpStatus();
        $data->status_name = $request->name;
        $data->created_by = Auth::User()->id;
        $data->updated_by = Auth::User()->id;
        $data->save();

        return redirect(route('Grade_category.index'));
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
        $data = EmpStatus::find($id);

        return $data;
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
            'name' => 'required',
        ]);
        $id = $request->id;
        $data = EmpStatus::find($id);
        $data->status_name = $request->name;
        $data->updated_by = Auth::User()->id;
        $data->save();

        return redirect(route('emp_status.index'));
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
        $data = EmpStatus::find($id);
        $data->delete();

        return $data;
    }
}   