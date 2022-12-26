<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public Function index()
    {
        $users_active_count = User::where('employee_status','ACTIVE')
                            ->where('id', '!=','1')
                            ->get()->count();
        $users_inactive_count = User::where('employee_status','INACTIVE')
                            ->where('id', '!=','1')
                            ->get()->count();

        return view('index', compact('users_active_count','users_inactive_count'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
