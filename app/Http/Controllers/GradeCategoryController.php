<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeCategory;
use Illuminate\Support\Facades\Auth;

class GradeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $GradeCategory = GradeCategory::all();
        return view('grade_category.index', compact('GradeCategory'));
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
            'grade_name' => 'required',
        ]);
        $level = new GradeCategory();
        $level->level = $request->level;
        $level->grade_name = $request->grade_name;
        $level->created_by = Auth::User()->id;
        $level->updated_by = Auth::User()->id;
        $level->save();

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
        $GradeCategory = GradeCategory::find($id);

        return $GradeCategory;

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
            'grade_name' => 'required'
        ]);
        $id = $request->id;
        $GradeCategory = GradeCategory::find($id);
        $GradeCategory->level = $request->level;
        $GradeCategory->grade_name = $request->grade_name;
        $GradeCategory->updated_by = Auth::User()->id;
        $GradeCategory->save();

        return redirect(route('Grade_category.index'));
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
        $GradeCategory = GradeCategory::find($id);
        $GradeCategory->delete();

        return $GradeCategory;
    }
}   