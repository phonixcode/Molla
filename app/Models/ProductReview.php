<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory, HasUUid;

    protected $fillable = [
        'user_id',
        'product_id',
        'rate',
        'review',
        'reason',
        'status'
    ];

    public function user_info(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
