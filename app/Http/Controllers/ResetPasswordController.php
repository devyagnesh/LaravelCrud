<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function showResetPassword()
    {
        return view('resetPassword');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_new_password'=>'required|same:new_password'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/dashboard')->with('success', 'Password changed successfully!');
    }
}
