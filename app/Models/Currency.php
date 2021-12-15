<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes, HasUUid;

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
        'code',
        'status'
    ];

    public static function getCurrencies()
    {
        return self::latest()->get();
    }

    public static function getActiveCurrencies()
    {
        return self::where('status', 'active')->get();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
