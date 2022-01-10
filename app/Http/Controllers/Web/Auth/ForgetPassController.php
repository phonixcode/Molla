<?php

namespace App\Http\Controllers\Web\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ForgetPassController extends Controller
{
    public function userForgetPass()
    {
        Session::put('url.intended', URL::previous());
        return view('frontend.pages.auth.forget-pass');
    }

    public function forgetPassSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('reset.password.form', ['token' => $token, 'email' => $request->email]);
        $body = "We are received a request to reset the password for account associated with " . $request->email . ". You can reset your password by clicking the link below";

        Mail::send('mail.email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('noreply@example.com');
            $message->to($request->email)
                ->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('frontend.pages.auth.reset-pass')
            ->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid token');
        } else {

            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();

            return redirect()->route('user.auth.login')
                ->with('success', 'Your password has been changed! You can login with new password')
                ->with('verifiedEmail', $request->email);
        }
    }
}
