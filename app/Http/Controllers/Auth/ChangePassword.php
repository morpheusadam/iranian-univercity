<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChangePassword extends Controller
{
    public function index()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ]);

        $user = User::find(auth()->user()->id);
        $updated = $user->update([
            'password' => $validated['password']
        ]);

        if ($updated)
            return back()->with('success', 'پسورد با موفقیت تغییر کرد.');
    }
}
