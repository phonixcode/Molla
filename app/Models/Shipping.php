<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory, HasUUid, SoftDeletes;

    protected $fillable = [
        'method',
        'delivery_time',
        'delivery_charge',
        'status',
    ];

    public static function getActiveShippings()
    {
        return Shipping::where('status', 'active')->orderBy('method', 'ASC')->get();
    }
}
