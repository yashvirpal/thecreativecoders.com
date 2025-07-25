<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@localhost.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'permissions' => ['manage_users', 'edit_posts', 'view_reports'],
        ]);
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'permissions' => ['manage_users', 'edit_posts', 'view_reports'],
        ]);

        Admin::create([
            'name' => 'Manager',
            'email' => 'manager@localhost.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
            'permissions' => ['edit_posts', 'view_reports'],
        ]);
    }
}
