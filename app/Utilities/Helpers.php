<?php

use App\Models\Currency;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Support\Facades\Session;

class Helper
{
    public static function userDefaultImage(): string
    {
        return asset('frontend/img/default.jpg');
    }

    public static function minPrice()
    {
        return floor(Product::min('offer_price'));
    }

    public static function maxPrice()
    {
        return floor(Product::max('offer_price'));
    }
}

// Settings SEO
if(!function_exists('get_setting'))
{
    function get_setting($key)
    {
        return Settings::value($key);
    }
}
