<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use App\Services\Status;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::orderBy('id', 'DESC')->get();
        return view('admin.shipping.index', compact('shippings'));
    }

    public function shippingStatus(Request  $request)
    {
        Status::toggleStatus($request, 'shippings');
        return response()->json(['msg' => 'Status updated successfully.', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        return Shipping::create($request->all())
            ? redirect()->route('shipping.index')->with('success', 'Successfully created shipping information.')
            : back()->with('errors', 'Error creating shipping information.');
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
    public function edit($uuid)
    {
        $shipping = Shipping::where('uuid', $uuid)->firstOrFail();
        return $shipping
            ? view('admin.shipping.edit', compact('shipping'))
            : back()->with('error', 'Date not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, $uuid)
    {
        $shipping = Shipping::where('uuid', $uuid)->firstOrFail();
        if ($shipping) {

            return $shipping->fill($request->all())->save()
            ? redirect()->route('shipping.index')->with('success', 'Successfully updated shipping information')
            : back()->with('errors', 'Error creating shipping information');

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
    public function destroy($uuid)
    {
        $shipping = Shipping::where('uuid', $uuid)->firstOrFail();
        if ($shipping) {
            return $shipping->delete()
                ? redirect()->route('shipping.index')->with('success', 'Shipping information deleted successfully')
                : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
