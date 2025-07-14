<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@localhost.com',
            'password' => Hash::make('password'),
        ]);
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => Hash::make('password'),
        ]);
    }
}
