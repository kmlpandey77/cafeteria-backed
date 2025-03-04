<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Admin::create([
//            'name' => 'System',
//            'email' => 'system@gmail.com',
//            'password' => Hash::make('password'),
//            'role' => AdminRole::Admin
//        ]);
//
//        Admin::create([
//            'name' => 'Agent',
//            'email' => 'agent@gmail.com',
//            'password' => Hash::make('password'),
//            'role' => AdminRole::Agent
//        ]);

        User::create([
            'org_id' => Organization::get()->random()->id,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin
        ]);
    }
}
