<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes, HasUUid;

    protected $fillable = [
        'product_id',
        'size',
        'original_price',
        'offer_price',
        'stock',
    ];
}
