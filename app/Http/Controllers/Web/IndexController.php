<?php

namespace App\Http\Controllers\Web;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id', 'DESC')->limit('5')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->limit('3')->get();
        $new_products = Product::where(['status' => 'active', 'condition' => 'new'])->orderBy('id', 'DESC')->limit('8')->get();
        $featured_products = Product::where(['status' => 'active', 'is_featured' => 1])->orderBy('id', 'DESC')->limit('6')->get();
        return view('frontend.pages.home.index', compact(
            'banners', 'categories', 'new_products', 'featured_products',
        ));
    }

    public function about()
    {
        return view('frontend.pages.about.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact.contact');
    }

    public function faq()
    {
        return view('frontend.pages.faq.faq');
    }
}
