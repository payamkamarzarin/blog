<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class SignoutController extends Controller
{
    public function signout() {
        Session::flush();
        Auth::logout();

        return Redirect('index');
    }
}
