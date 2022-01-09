<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'photo', 'status', 'condition'];

    public static function getBanners()
    {
        return Banner::latest()->get();
    }

    public static function BannerWithPromo()
    {
        return self::where(['status' => 'active', 'condition' => 'promo'])
            ->orderBy('id', 'DESC')
            ->first();
    }

    public static function BannerWithBanners()
    {
        return self::where(['status' => 'active', 'condition' => 'banner'])
            ->orderBy('id', 'DESC')
            ->limit('5')
            ->get();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
