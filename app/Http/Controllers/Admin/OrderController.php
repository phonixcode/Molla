<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.index', [
            'orders' => Order::getOrders()
        ]);
    }

    public function orderStatus(Request $request)
    {
        $order = Order::find($request->input('order_id'));
        if ($order) {
            if ($request->input('condition') == 'cancelled') {
                foreach ($order->products as $item) {
                    $product = Product::where('id', $item->pivot->product_id)->first();
                    $stock = $product->stock;
                    $stock += $item->pivot->quantity;
                    $product->update(['stock' => $stock]);
                    Order::where('id', $request->input('order_id'))->update(['payment_status' => 'unpaid']);
                }
            }

            if ($request->input('condition') == 'delivered') {
                foreach ($order->products as $item) {
                    Order::where('id', $request->input('order_id'))->update(['payment_status' => 'paid']);
                }
            }

            $status = Order::where('id', $request->input('order_id'))
                ->update(['condition' => $request->input('condition')]);

            return $status
                ? back()->with('success', 'Order Status updated successfully')
                : back()->with('error', 'Something went wrong');
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if ($order) {
            return view('admin.order.show', compact('order'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order) {
            return $order->delete()
                ? redirect()->route('order.index')->with('success', 'Order deleted successfully')
                : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
