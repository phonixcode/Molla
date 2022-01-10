<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkoutOne()
    {
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout-1', compact('user'));
    }

    public function checkoutOneStore(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|email|exists:users,email',
            'phone'         => 'required|string',
            'address'       => 'required|string',
            'city'          => 'required|string',
            'country'       => 'nullable|string',
            'state'         => 'nullable|string',
            'postcode'      => 'nullable|numeric',
            'note'          => 'nullable|string',
            's_address'     => 'required|string',
            's_city'        => 'required|string',
            's_country'     => 'nullable|string',
            's_state'       => 'nullable|string',
            's_postcode'    => 'nullable|numeric',
        ]);

        Session::put('checkout', $request->all());
        $shippings = Shipping::getActiveShippings();

        return view('frontend.pages.checkout.checkout-2', compact('shippings'));
    }

    public function checkoutTwoStore(Request $request)
    {
        $this->validate($request, ['delivery_charge' => 'required|numeric']);
        Session::push('checkout', ['delivery_charge' => $request->delivery_charge]);
        return view('frontend.pages.checkout.checkout-3');
    }

    public function checkoutThreeStore(Request $request)
    {
        $this->validate($request, [
            'payment_method' => 'required|string',
            'payment_status' => 'string|in:paid,unpaid'
        ]);

        Session::push('checkout', [
            'payment_method' => $request->payment_method,
            'payment_status' => 'unpaid',
        ]);
        return view('frontend.pages.checkout.checkout-4');
    }

    public function checkoutSubmit()
    {
        $subtotal = floatval(implode(explode(',', Session::get('checkout')['sub_total'])));
        $delivery_charge = floatval(Session::get('checkout')[0]['delivery_charge']);

        $order = new Order();
        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD-' . Str::random(6));
        $order['sub_total'] = $subtotal;
        $order['coupon'] = Session::has('coupon') ? Session::get('coupon')['value'] : 0;
        $order['delivery_charge'] = $delivery_charge;
        $order['total_amount'] = $subtotal + $delivery_charge - $order['coupon'];
        $order['payment_method'] = Session::get('checkout')[1]['payment_method'];
        $order['payment_status'] = Session::get('checkout')[1]['payment_status'];
        $order['condition'] = 'pending';
        $order['first_name'] = Session::get('checkout')['first_name'];
        $order['last_name'] = Session::get('checkout')['last_name'];
        $order['email'] = Session::get('checkout')['email'];
        $order['phone'] = Session::get('checkout')['phone'];
        $order['address'] = Session::get('checkout')['address'];
        $order['state'] = Session::get('checkout')['state'];
        $order['country'] = Session::get('checkout')['country'];
        $order['city'] = Session::get('checkout')['city'];
        $order['postcode'] = Session::get('checkout')['postcode'];
        $order['note'] = Session::get('checkout')['note'];
        $order['s_first_name'] = Session::get('checkout')['s_first_name'];
        $order['s_last_name'] = Session::get('checkout')['s_last_name'];
        $order['s_email'] = Session::get('checkout')['s_email'];
        $order['s_phone'] = Session::get('checkout')['s_phone'];
        $order['s_address'] = Session::get('checkout')['s_address'];
        $order['s_state'] = Session::get('checkout')['s_state'];
        $order['s_country'] = Session::get('checkout')['s_country'];
        $order['s_city'] = Session::get('checkout')['s_city'];
        $order['s_postcode'] = Session::get('checkout')['s_postcode'];

        $status = $order->save();

        foreach (Cart::instance('shopping')->content() as $item) {
            $product_id[] = $item->id;
            $product = Product::find($item->id);
            $quantity = $item->qty;
            $stock = $product->stock;
            $stock -= $quantity;
            $product->update(['stock' => $stock]);
            $order->products()->attach($product, ['quantity' => $quantity]);
        }

        if ($status) {
            $order->sendNotificationMail();
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('complete', $order['order_number']);
        } else {
            return redirect()->route('checkout.one')->with('error', 'Please try again');
        }
    }

    public function complete($order)
    {
        $order = $order;
        return view('frontend.pages.checkout.checkout-complete', compact('order'));
    }
}
