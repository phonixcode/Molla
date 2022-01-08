<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasUUid;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'additional_info',
        'return_cancellation',
        'size_guide',
        'stock',
        'price',
        'offer_price',
        'discount',
        'is_featured',
        'condition',
        'status',
        'photo',
        'brand_id',
        'vendor_id',
        'cat_id',
        'child_cat_id',
        'size',
    ];

    public static function getActiveProduct()
    {
        return self::where('status', 'active')->get();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'id', 'brand_id');
    }

    public function related_products()
    {
        return $this->hasMany($this, 'cat_id', 'cat_id')
                    ->where('status', 'active')
                    ->inRandomOrder()->limit(10);
    }

    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')
                    ->with('user_info')->latest();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders')
                    ->withPivot('quantity');
    }

    public static function getProductByCart($id)
    {
        return self::where('id', $id)->get()->toArray();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
