<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        $last_id = $check->id;
        $token = $last_id . hash('sha256', Str::random(120));
        $verifyURL = route('user.auth.verify', ['token' => $token, 'service' => 'Email_verification']);

        VerifyUser::create([
            'user_id' => $last_id,
            'token' => $token,
        ]);

        $message = 'Dear <b>' . $request->full_name . ',</b> <br>';
        $message .= 'Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $mail_data = [
            'recipient' => $request->email,
            'fromEmail' => $request->email,
            'fromName' => $request->name,
            'subject' => 'Email Verification',
            'body' => $message,
            'actionLink' => $verifyURL,
        ];

        Mail::send('mail.email-verify', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                ->subject($mail_data['subject']);
        });

        Session::put('user', $data['email']);
        //Auth::login($check);

        return ($check)
            ? redirect()->route('home')->with('success', 'You need to verify your account. We have sent you an activation link, please check your email.')
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

    public function verify(Request $request)
    {
        $token = $request->token;
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();

                return redirect()->route('user.auth.login')
                    ->with('success', 'Your email is verified successfully. You can now login')
                    ->with('verifiedEmail', $user->email);
            } else {
                return redirect()->route('user.auth.login')
                    ->with('success', 'Your email is already verified. You can now login')
                    ->with('verifiedEmail', $user->email);
            }
        }
    }
}
