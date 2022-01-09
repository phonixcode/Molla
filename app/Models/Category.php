<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'summary', 'photo', 'is_parent', 'parent_id', 'status'];

    public static function getActiveCategories()
    {
        return self::where('status', 'active')->get();
    }

    public static function featuredCategory()
    {
        return self::where(['status' => 'active', 'is_parent' => 1])
            ->orderBy('id', 'DESC')
            ->limit('3')
            ->get();
    }

    public static function shiftChild($cat_id)
    {
        return self::whereIn('id', $cat_id)->update(['is_parent' => 1]);
    }

    public static function getChildByParentID($id)
    {
        return self::where('parent_id', $id)->pluck('title', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id')->where('status', 'active');
    }
}
