<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // dd(auth()->user());
        // User::create([
        //     'name' => 'user',
        //     'email' => 'user@example.com',
        //     'password' => bcrypt('123'),
        // ]);
        return view('user.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth('web')->attempt($credentials)) {

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('user.login');
    }
}
