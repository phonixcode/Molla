<?php

namespace App\Models;

use App\Traits\HasUUid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUUid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'username',
        'photo',
        'phone',
        'email',
        'password',
        'status',
        'country',
        'city',
        'postcode',
        'state',
        'address',
        's_country',
        's_city',
        's_postcode',
        's_state',
        's_address',
        'email_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers()
    {
        return self::orderBy('id', 'DESC')->get();
    }

    public static function getActiveUsers()
    {
        return self::where('status', 'active')->get();
    }

    /**
     * Get the Orders associated with the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the Completed Orders associated with the user.
     */
    public function completedOrders()
    {
        return $this->hasMany(Order::class)->where('condition', 'delivered');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
