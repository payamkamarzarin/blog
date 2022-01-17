<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('Auth.register');
    }


    public function customRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('User/dashboard')->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    public function dashboard(){
        if(Auth::check()){
            if(Auth::user()->is_admin == 1){
                return view('Admin.dashboard');

            }
            return view('User.dashboard');

        }
        return redirect("Auth/login")->withSuccess('Login details are not valid');
    }
}
