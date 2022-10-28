<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function formlogin()
    {
        return view('login');
    }

    public function actionlogin(Request $request)
    {
            $nik = $request->nik;
            $password = $request->password;

            if(Auth::attempt(['nik' => $nik, 'password' => $password, 'job_status' => 'active',])) {
                return redirect('/');
            }else{
                return redirect()->back()->with('message', 'Login Gagal, Pastikan email dan password sudah benar !');
            }
    }
}
