<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KpiController extends Controller
{
    public function create()
    {
        $p = DB::table('pertanyaans')->get();
        return view('kpi.postkpi', compact('p'));
    }
}
