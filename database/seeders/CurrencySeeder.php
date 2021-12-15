<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'USA Dollar',
            'symbol' => '$',
            'exchange_rate' => 1,
            'code' => 'USD',
        ]);

        Currency::create([
            'name' => 'Euro',
            'symbol' => '€',
            'exchange_rate' => 50,
            'code' => 'Euro',
        ]);

        Currency::create([
            'name' => 'Naira',
            'symbol' => '&#8358',
            'exchange_rate' => 500,
            'code' => 'NGN',
        ]);
    }
}
