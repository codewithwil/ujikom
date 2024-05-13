<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\globalC;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};

class LoginController extends globalC
{
    public function index(){
        return view('back.login.index');
    }

    public function login(Request $request){
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ], [
            'email.required'    => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) 
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
