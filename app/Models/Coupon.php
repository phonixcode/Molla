<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'value',
        'status'
    ];

    public function discount($total)
    {
        if ($this->type == "fixed") {
            return $this->value;
        } else if ($this->type == "percent") {
            return ($this->value / 100) * $total;
        } else {
            return 0;
        }
    }
}
