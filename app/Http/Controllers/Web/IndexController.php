<?php

namespace App\Http\Controllers\Web;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Settings;
use App\Mail\ContactMail;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            Cart::instance('shopping')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
            Cart::instance('compare')->restore(Auth::user()->email);
        }

        return view('frontend.pages.home.index', [
            'banners'               => Banner::BannerWithBanners(),
            'promo_banner'          => Banner::BannerWithPromo(),
            'categories'            => Category::featuredCategory(),
            'brands'                => Brand::getActiveBrands(),
            'new_products'          => Product::newProducts(),
            'featured_products'     => Product::featuredProducts(),
            'top_products'          => Product::getTopProducts(),
            'best_rated_products'   => Product::getBestRatedProducts(),
        ]);
    }

    public function about()
    {
        return view('frontend.pages.about.about', [
            'brands' => Brand::getActiveBrands(),
        ]);
    }

    public function contact()
    {
        return view('frontend.pages.contact.contact', [
            'setting' => Settings::first()
        ]);
    }

    public function contactSubmit(ContactRequest $request)
    {
        $status = Mail::to('abbyfuncode@gmail.com')->queue(new ContactMail($request->all()));
        return (!$status)
            ? back()->with('success', 'Enquiry sent successfully')
            : back()->with('error', 'Something went wrong!, please try again later');
    }

    public function faq()
    {
        return view('frontend.pages.faq.faq');
    }
}
