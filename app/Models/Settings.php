<?php

namespace App\Models;

use App\Traits\HasUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory, HasUUid;

    protected $fillable = [
        'title',
        'meta_description',
        'meta_keywords',
        'logo',
        'favicon',
        'address',
        'email',
        'phone',
        'fax',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'pinterest_url',
    ];
}
