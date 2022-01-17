<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('Auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->is_admin == 1){
                return redirect(route('Admin.dashboard'));

            }
            return redirect(route('User.dashboard'));

        }
        return redirect("Auth/login")->withSuccess('Login details are not valid');
    }
}
