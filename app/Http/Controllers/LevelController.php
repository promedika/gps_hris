<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();
        return view('level.index', compact('levels'));
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
            'level'   => 'required',
            'name'   => 'required',
        ]);
        $level = new level();
        $level->level = $request->level;
        $level->lev_name = $request->name;
        $level->created_by = Auth::User()->id;
        $level->updated_by = Auth::User()->id;
        $level->save();

        return redirect(route('level.index'));
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
        $level = Level::find($id);

        return $level;
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
            'level'=>'required',
            'name'=>'required',
        ]);
        $id = $request->id;
        $level = Level::find($id);
        $level->level = $request->level;
        $level->lev_name = $request->name;
        $level->updated_by = Auth::User()->id;
        $level->save();
        return redirect(route('level.index'));
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
        $level = Level::find($id);
        $level->delete();

        return $level;
        // return view('level.index', compact('levels'));
    }
}   