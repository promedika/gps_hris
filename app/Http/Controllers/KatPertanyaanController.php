<?php

namespace App\Http\Controllers;

use App\Models\KatPertanyaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KatPertanyaanController extends Controller
{
    public function index()
    {
        if(Auth::User()->role != 1){
        $katPers = KatPertanyaan::all();
        return view('kategori.index', compact('katPers'));
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
            'nama'=>'required',
            
        ]);
        $katPer = new KatPertanyaan();
        $katPer->kategori = $request->kategori;
        $katPer->nama= $request->nama;
        $katPer->save();

        return redirect(route('katPer.index'));
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
        $katPer = KatPertanyaan::find($id);
        return response()->json(['data' => $katPer]);
        return redirect(route('katPer.index'));
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
            'kategori'=>'required',
            'nama'=>'required',
        ]);

        
        $id = $request->id;
        $katPer = KatPertanyaan::find($id);
        $katPer->kategori = $request->kategori;
        $katPer->nama = $request->nama;
        $katPer->save();
        return redirect(route('kategori.index'));
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
        $katPer = KatPertanyaan::find($id);
        $katPer->delete();
        return $katPer;

        return view('kategori.index', compact('katPers'));
    }
}
