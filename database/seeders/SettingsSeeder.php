<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'title' => 'Molla Online Shopping',
            'meta_description' => 'Molla online shopping',
            'meta_keywords' => 'Molla, online shopping, shopping, online store, E-commerce website',
            'logo' => 'frontend/img/core-img/logo.png',
            'favicon' => 'frontend/img/core-img/logo-icon.png',
            'address' => 'Lords, London, UK - 1259',
            'email' => 'support@molla.com',
            'phone' => '002 63695 24624',
            'fax' => '002 78965 369552',
            'facebook_url' => '',
            'twitter_url' => '',
            'instagram_url' => '',
            'linkedin_url' => '',
            'pinterest_url' => '',
        ]);
    }
}
