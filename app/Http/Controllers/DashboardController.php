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
        $users_count = User::all()->count();
        return view('index', compact('users_count'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
