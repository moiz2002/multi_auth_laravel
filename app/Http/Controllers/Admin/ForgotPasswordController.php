<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function forgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        // dd('nvgkjr');
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );
        // dd($status);

        return $status === Password::broker('admins')::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function resetFrom(Request $request)
    {
        // dd($request->token);
        $token = $request->token;
        $email = $request->email;
        return view('admin.auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', 'Password reset successfully.');
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }
}
