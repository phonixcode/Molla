<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
    ];
}
