<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CompareController extends Controller
{
    public function compare()
    {
        return view('frontend.pages.compare.compare');
    }

    public function compareStore(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $title = $product[0]['title'];

        $compare_array = [];
        foreach (Cart::instance('compare')->content() as $item) {
            $compare_array[] = $item->id;
        }

        if (in_array($product_id, $compare_array)) {
            $response['present'] = true;
            $response['message'] = "Item is already in compare";
        } elseif (count($compare_array) >= 4) {
            $response['status'] = false;
            $response['message'] = "You can't add more than 4 items";
        } elseif ($product[0]['stock'] <= 0) {
            $response['status'] = false;
            $response['message'] = "We don't have enough items";
        } else {
            $result = Cart::instance('compare')->add($product_id, $title, 1, $price)->associate(Product::class);
            if ($result) {
                $response['status'] = true;
                $response['message'] = "Item has been saved in compare list";
                $response['compare_count'] = Cart::instance('compare')->count();
            }
        }

        if(Auth::check()){
            Cart::instance('compare')->store(Auth::user()->email);
        }

        return json_encode($response);
    }

    public function compareMoveToCart(Request $request)
    {
        $item = Cart::instance('compare')->get($request->input('rowId'));
        Cart::instance('compare')->remove($request->input('rowId'));
        $result = Cart::instance('shopping')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);

        if ($result) {
            $response['status'] = true;
            $response['message'] = "Item has been moved to cart";
            $response['cart_count'] = Cart::instance('shopping')->count();
        }

        if ($request->ajax()) {
            $compare = view('frontend.pages.compare._compare_lists')->render();
            $header = view('frontend.layouts.header')->render();
            $response['compare_list'] = $compare;
            $response['header'] = $header;
        }

        return $response;
    }

    public function compareMoveToWishlist(Request $request)
    {
        $item = Cart::instance('compare')->get($request->input('rowId'));
        Cart::instance('compare')->remove($request->input('rowId'));
        $result = Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);

        if ($result) {
            $response['status'] = true;
            $response['message'] = "Item has been moved to wishlist";
            //$response['wishlist_counter'] = Cart::instance('wishlist')->count();
        }

        if ($request->ajax()) {
            $wishlist = view('frontend.pages.wishlist._wishlist_lists')->render();
            $compare = view('frontend.pages.compare._compare_lists')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['compare_list'] = $compare;
            $response['header'] = $header;
        }

        return $response;
    }

    public function compareDelete(Request $request)
    {
        $id = $request->input('rowId');
        Cart::instance('compare')->remove($id);

        $response['status'] = true;
        $response['message'] = "Item successfully removed from wishlist";

        if(Auth::check()){
            Cart::instance('compare')->store(Auth::user()->email);
        }

        if ($request->ajax()) {
            $compare = view('frontend.pages.compare._compare_lists')->render();
            $header = view('frontend.layouts.header')->render();
            $response['compare_list'] = $compare;
            $response['header'] = $header;
        }

        return $response;
    }
}
