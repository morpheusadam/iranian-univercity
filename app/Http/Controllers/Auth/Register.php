<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'unique:users,username', 'min:4'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ]);

        unset($validated['password_confirmation']);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login')->with('registered', 'ایجاد حساب با موفقیت انجام شد!');
    }
}
