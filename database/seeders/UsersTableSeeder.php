<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'full_name' => 'Admin Bob',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'status' => 'active',
        ]);

        User::create([
            'full_name' => 'Customer Bob',
            'username' => 'abby2020',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer12345'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
