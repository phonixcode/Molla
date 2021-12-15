<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:4',
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended(route('admin'))->with('success', 'Login Successfully');
        }

        return back()->withInput($request->only('email'))->with('error', 'Invalid email & password!');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->home()->with('success', 'Successfully logout');
    }
}
