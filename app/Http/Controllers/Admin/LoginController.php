<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLoginRequest;

class LoginController extends Controller
{
    //

    public function login(){
        return view('admin.auth.login');
    }
                            // validation
    public function checkAdmin(adminLoginRequest $request){

        $remember_me = $request -> has('remember_me') ? true : false;

        if (auth() -> guard('admin') -> attempt(['email' => $request->input('email'), 'password' => $request -> input('password')], $remember_me)){
            return redirect() -> route('admin.dashboard');
        }

        return redirect() -> back() -> with(['error' => 'There is some wrong information']);
    }
}
