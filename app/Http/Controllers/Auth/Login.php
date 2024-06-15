<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'username' => ['required', 'exists:users'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('login-success', 'ورود موفقیت آمیز بود. خوش آمدید!');
        }

        return back()->withErrors([
            'password' => 'رمز عبور وارد شده صحیح نمی باشد.',
        ])->onlyInput('password');
    }
}
