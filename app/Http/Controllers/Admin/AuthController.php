<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate( [
            'email' =>'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth('admin')->attempt($credentials)) {

            return redirect()->intended(route('admin.dashboard'));

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(){
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
