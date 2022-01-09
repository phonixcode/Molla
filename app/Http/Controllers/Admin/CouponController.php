<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Helper;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function couponStatus(Request $request, Coupon $coupon)
    {
        Helper::toggleStatus($request, $coupon);
        return response()->json(['msg' => 'Status updated successfully.', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|min:2',
            'type' => 'required|in:fixed,percent',
            'status' => 'required|in:active,inactive',
            'value' => 'required|numeric'
        ]);

        $data = $request->all();

        return (Coupon::create($data))
            ? redirect()->route('coupon.index')->with('success', 'Coupon successfully created')
            : back()->with('error', 'Error creating coupon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //$user = User::where('uuid', $uuid)->firstOrFail();
        return ($coupon)
            ? view('admin.coupon.edit', compact('coupon'))
            : back()->with('error', 'Coupon not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        if ($coupon) {
            $this->validate($request, [
                'code' => 'required|min:2',
                'type' => 'required|in:fixed,percent',
                'status' => 'required|in:active,inactive',
                'value' => 'required|numeric'
            ]);

            $data = $request->all();

            return ($coupon->fill($data)->save())
            ? redirect()->route('coupon.index')->with('success', 'Successfully updated coupon')
            : back()->with('errors', 'Error creating coupon');

        } else {
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if ($coupon) {
            return ($coupon->delete())
            ? redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully')
            : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
