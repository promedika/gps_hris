<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TerminateReason;
use Illuminate\Support\Facades\Auth;

class TerminateReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TerminateReason::all();
        return view('terminate_reason.index', compact('datas'));
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
        $data = new TerminateReason();
        $data->name = $request->name;
        $data->created_by = Auth::User()->id;
        $data->updated_by = Auth::User()->id;
        $data->save();

        return redirect(route('terminate_reason.index'));
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
        $data = TerminateReason::find($id);

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
        $data = TerminateReason::find($id);
        $data->name = $request->name;
        $data->updated_by = Auth::User()->id;
        $data->save();

        return redirect(route('terminate_reason.index'));
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
        $data = TerminateReason::find($id);
        $data->delete();

        return $data;
    }
}   