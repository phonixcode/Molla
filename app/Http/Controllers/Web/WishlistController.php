<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function wishlist()
    {
        return view('frontend.pages.wishlist.wishlist');
    }

    public function wishlistStore(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $title = $product[0]['title'];

        $wishlist_array = [];
        foreach (Cart::instance('wishlist')->content() as $item) {
            $wishlist_array[] = $item->id;
        }

        if (in_array($product_id, $wishlist_array)) {
            $response['present'] = true;
            $response['message'] = "Item is already in your wishlist";
        } else {
            $result = Cart::instance('wishlist')->add($product_id, $title, $product_qty, $price)->associate(Product::class);
            if ($result) {
                $response['status'] = true;
                $response['message'] = "Item has been saved in wishlist";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
        }

        if(Auth::check()){
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return json_encode($response);
    }

    public function wishlistMoveToCart(Request $request)
    {
        $item = Cart::instance('wishlist')->get($request->input('rowId'));
        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result = Cart::instance('shopping')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);

        if ($result) {
            $response['status'] = true;
            $response['message'] = "Item has been moved to cart";
            $response['cart_count'] = Cart::instance('shopping')->count();
        }

        if($request->ajax()){
            $wishlist = view('frontend.pages.wishlist._wishlist_lists')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }

       return $response;
    }

    public function wishlistDelete(Request $request)
    {
        $id = $request->input('rowId');
        Cart::instance('wishlist')->remove($id);

        $response['status'] = true;
        $response['message'] = "Item successfully removed from wishlist";

        if(Auth::check()){
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        if($request->ajax()){
            $wishlist = view('frontend.pages.wishlist._wishlist_lists')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }

        return $response;
    }
}
