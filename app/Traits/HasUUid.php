<?php

namespace App\Traits;

use Illuminate\Support\Str;


trait HasUUid
{
    /**
     *Create uuid when a new user is to be created
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->uuid = (string) Str::uuid();
        });
    }
}
