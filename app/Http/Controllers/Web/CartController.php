<?php

namespace App\Http\Controllers\Web;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cart()
    {
        return view('frontend.pages.cart.cart');
    }

    public function cartStore(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $title = $product[0]['title'];

        $result = Cart::instance('shopping')->add($product_id, $title, $product_qty, $price)->associate(Product::class);

        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item was added to cart";
        }

        if(Auth::check()){
            Cart::instance('shopping')->store(Auth::user()->email);
        }

        if ($request->ajax()) {
            $headers = view('frontend.layouts.header')->render();
            $response['header'] = $headers;
        }
        return json_encode($response);
    }

    public function cartDelete(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Item removed successfully";

        if(Auth::check()){
            Cart::instance('shopping')->store(Auth::user()->email);
        }

        if ($request->ajax()) {
            $headers = view('frontend.layouts.header')->render();
            $cart_list = view('frontend.pages.cart._cart_lists')->render();
            $response['header'] = $headers;
            $response['cart_list'] = $cart_list;
        }
        return json_encode($response);
    }

    public function cartUpdate(Request $request)
    {
        $this->validate($request, [
            'product_qty' => 'required|numeric',
        ]);

        $rowId = $request->input('rowId');
        $request_quantity = $request->input('product_qty');
        $productQuantity = $request->input('productQuantity');

        if($request_quantity > $productQuantity){
            $message = "We currently do not have enough items in stock";
            $response['status'] = false;
        }elseif($request_quantity < 1){
            $message = "You can't add less than one item";
            $response['status'] = false;
        }else{
            Cart::instance('shopping')->update($rowId,$request_quantity);
            $message = "Quantity was successfully updated";
            $response['status'] = true;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
        }

        if ($request->ajax()) {
            $headers = view('frontend.layouts.header')->render();
            $cart_list = view('frontend.pages.cart._cart_lists')->render();
            $response['header'] = $headers;
            $response['cart_list'] = $cart_list;
            $response['message'] = $message;
        }
        return $response;
    }

    public function couponAdd(Request $request)
    {
        $coupon = Coupon::where('code', $request->input('code'))->first();
        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code, Please enter a valid coupon code');
        }

        $total_price = floatval(implode(explode(',',Cart::instance('shopping')->subtotal())));
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'value' => $coupon->discount($total_price),
        ]);
        return back()->with('success', 'Coupon applied successfully');
    }
}
