<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Default roles
        DB::table('role')->insert([
            'name' => 'Administrator',
            'description' => 'Administrator role'
        ]);

        DB::table('role')->insert([
            'name' => 'Guest',
            'description' => 'Guest role'
        ]);

        // Default permissions
        DB::table('permission')->insert([
            'name' => 'user.read',
            'description' => 'Read user data'
        ]);

        DB::table('permission')->insert([
            'name' => 'user.modify',
            'description' => 'Modify user data'
        ]);

        DB::table('permission')->insert([
            'name' => 'user.delete',
            'description' => 'Delete user data'
        ]);

        DB::table('role_to_permission')->insert([
            'role_id' => 1,
            'permission_id' => 1
        ]);

        DB::table('role_to_permission')->insert([
            'role_id' => 1,
            'permission_id' => 2
        ]);

        DB::table('role_to_permission')->insert([
            'role_id' => 1,
            'permission_id' => 3
        ]);

        // Default users
        DB::table('user')->insert([
            'name' => 'admin',
            'display_name' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);

        DB::table('user')->insert([
            'name' => 'guest',
            'display_name' => 'guest',
            'password' => Hash::make('guest'),
            'role_id' => 2
        ]);
    }
}
