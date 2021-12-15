<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function userRegister()
    {
        Session::put('url.intended', URL::previous());
        return view('frontend.pages.auth.register');
    }

    public function RegisterSubmit(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'username' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        Session::put('user', $data['email']);
        Auth::login($check);

        return ($check)
        ? redirect()->route('home')->with('success', 'Successfully Registered')
        : back()->with('error', ['Please check your credentials']);
    }

    private function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
