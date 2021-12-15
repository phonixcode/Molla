<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function userLogin()
    {
        Session::put('url.intended', URL::previous());
        return view('frontend.pages.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])){
            Session::put('user', $request->email);

            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }else{
                return redirect()->route('home')->with('success', 'Successfully login');
            }
        }else{
            return back()->with('error', 'Invalid email & password!');
        }
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->home()->with('success', 'Successfully logout');
    }
}
