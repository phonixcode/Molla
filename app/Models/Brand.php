<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'photo', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 'active');
    }

    // public function products(){
    //     return $this->hasMany('App\Models\Product','brand_id','id')->where('status','active');
    // }
}
