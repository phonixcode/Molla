<?php

namespace App\Models;

use App\Mail\OrderMail;
use App\Traits\HasUUid;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, HasUUid, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_number',
        'product_id',
        'sub_total',
        'total_amount',
        'quantity',
        'deliver_charge',
        'coupon',
        'condition',
        'payment_method',
        'payment_status',

        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'postcode',
        'city',

        's_first_name',
        's_last_name',
        's_email',
        's_phone',
        's_address',
        's_country',
        's_state',
        's_postcode',
        's_city',
        'note'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')
                    ->withPivot('quantity');
    }

    public function sendNotificationMail()
    {
        Mail::to($this['email'])
            ->bcc($this['s_email'])
            ->cc('abbyfuncode@gmail.com')
            ->queue(new OrderMail($this));
    }

    public static function getOrders()
    {
        return self::latest()->get();
    }

    public static function getLatestOrders()
    {
        return self::latest()->limit(5)->get();
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
