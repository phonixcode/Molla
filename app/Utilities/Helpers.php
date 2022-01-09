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

    /**
     * @param Request $request
     * @param $table
     */
    public static function toggleStatus($request, $toggleStatus)
    {
        if (!empty($request)) {
            if ($request->mode == 'true') {
                $toggleStatus::where('id', $request->id)->update(['status' => 'active']);
            }else{
                $toggleStatus::where('id', $request->id)->update(['status' => 'inactive']);
            }
        }
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
