<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bobot;
use Illuminate\Support\Facades\Auth;

class BobotController extends Controller
{
    public function index()
    {
        if(Auth::User()->role != 1){
        $bobots = Bobot::all();
        return view('bobot.index', compact('bobots'));
        }else{
        return redirect('error.404');
        }
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

        // dd($request);
        $this->validate($request,[
            'Kat_id'=>'required',
            'nilai'=>'required',
            
        ]);
        $bobot = new bobot();
        $bobot->kat_id = $request->kat_id;
        $bobot->nilai= $request->nilai;
        $bobot->save();

        return redirect(route('bobot.index'));
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
        $bobot = Bobot::find($id);
        return response()->json(['data' => $bobot]);
        return redirect(route('bobot.index'));
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
            'kat_id'=>'required',
            'nilai'=>'required',
        ]);

        
        $id = $request->id;
        $bobot = Bobot::find($id);
        $bobot->kat_id = $request->kat_id;
        $bobot->nilai = $request->nilai;
        $bobot->save();
        return redirect(route('bobot.index'));
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
        $bobot = Bobot::find($id);
        $bobot->delete();
        return $bobot;

        return view('bobot.index', compact('bobots'));
    }
}
