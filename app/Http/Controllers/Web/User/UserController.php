<?php

namespace App\Http\Controllers\Web\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();
        return view('frontend.user.dashboard', compact('user'));
    }

    public function userOder()
    {
        $uuid = Auth::user()->uuid;
        $user = User::where('uuid', $uuid)->with('orders')->firstOrFail();
        return view('frontend.user.order', compact('user'));
    }

    public function userAddress()
    {
        $user = Auth::user();
        return view('frontend.user.address', compact('user'));
    }

    public function userAccountDetail()
    {
        $user = Auth::user();
        return view('frontend.user.account-detail', compact('user'));
    }

    public function updateAccount(Request $request, $uuid)
    {
        $this->validate($request,[
            'oldpassword'   => 'nullable|min:4',
            'newpassword'   => 'nullable|min:4',
            'full_name'     => 'required|string',
            'username'      => 'nullable|string',
            'phone'         => 'nullable|min:8',
        ]);

        $hashPassword = Auth::user()->password;

        if($request->oldpassword == null && $request->newpassword == null){
            User::where('uuid', $uuid)->update([
                'full_name' => $request->full_name,
                'username' => $request->username,
                'phone' => $request->phone
            ]);
            return back()->with('success', 'Account updated successfully');
        }else{
            if(Hash::check($request->oldpassword, $hashPassword)){
                if(!Hash::check($request->newpassword, $hashPassword)){
                    User::where('uuid', $uuid)->update([
                        'full_name' => $request->full_name,
                        'username' => $request->username,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->newpassword)
                    ]);
                    return back()->with('success', 'Account updated successfully');
                }else{
                    return back()->with('error', 'New password cannot be the same with old password');
                }
            }else{
                return back()->with('error', 'Old password does not match');
            }
        }

    }

    public function billingAddress(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->update([
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
        ]);

        return $user
        ? back()->with('success', 'Billing Address successfully update')
        : back()->with('error', 'Something went wrong');
    }

    public function shippingAddress(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->update([
            's_address' => $request->s_address,
            's_country' => $request->s_country,
            's_city' => $request->s_city,
            's_postcode' => $request->s_postcode,
            's_state' => $request->s_state,
        ]);

        return $user
        ? back()->with('success', 'Shipping Address successfully update')
        : back()->with('error', 'Something went wrong');
    }
}
