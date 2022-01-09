<?php

namespace App\Http\Controllers\Web;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home()
    {
        return view('frontend.pages.home.index', [
            'banners'           => Banner::BannerWithBanners(),
            'promo_banner'      => Banner::BannerWithPromo(),
            'categories'        => Category::featuredCategory(),
            'brands'            => Brand::getActiveBrands(),
            'new_products'      => Product::newProducts(),
            'featured_products' => Product::featuredProducts(),
            'top_products'      => Product::getTopProducts(),
            'best_rated_products'        => Product::getBestRatedProducts(),
        ]);
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
