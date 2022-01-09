<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgetPassController extends Controller
{
    public function userForgetPass()
    {
        //Session::put('url.intended', URL::previous());
        return view('frontend.pages.auth.forget-pass');
    }

    public function forgetPassSubmit(Request $request)
    {
        return $request->all();
    }
}
