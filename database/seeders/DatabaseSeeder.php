<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

        DB::table('role')->insert([
            'name' => 'Manager',
            'description' => 'Manager role'
        ]);

        // Default permissions
        // User
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
            'description' => 'Delete users'
        ]);

        // Role
        DB::table('permission')->insert([
            'name' => 'role.read',
            'description' => 'Read role data'
        ]);

        DB::table('permission')->insert([
            'name' => 'role.modify',
            'description' => 'Modify role data'
        ]);

        DB::table('permission')->insert([
            'name' => 'role.delete',
            'description' => 'Delete roles'
        ]);

        // Permission
        DB::table('permission')->insert([
            'name' => 'permission.read',
            'description' => 'Read permission data'
        ]);

        DB::table('permission')->insert([
            'name' => 'permission.modify',
            'description' => 'Modify permission data'
        ]);

        DB::table('permission')->insert([
            'name' => 'permission.delete',
            'description' => 'Delete permissions'
        ]);

        // Task
        DB::table('permission')->insert([
            'name' => 'task.read',
            'description' => 'Read task data'
        ]);

        DB::table('permission')->insert([
            'name' => 'task.modify',
            'description' => 'Modify task data'
        ]);

        DB::table('permission')->insert([
            'name' => 'task.close',
            'description' => 'Close tasks'
        ]);

        DB::table('permission')->insert([
            'name' => 'task.delete',
            'description' => 'Delete tasks'
        ]);

        // Link roles to permissions
        DB::table('role_to_permission')->insert([
            'role_id' => 3,
            'permission_id' => 1
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

        DB::table('user')->insert([
            'name' => 'manager',
            'display_name' => 'manager',
            'password' => Hash::make('manager'),
            'role_id' => 3
        ]);

        // Default task statuses
        DB::table('task_status')->insert([
            'name' => 'new'
        ]);

        DB::table('task_status')->insert([
            'name' => 'active'
        ]);

        DB::table('task_status')->insert([
            'name' => 'paused'
        ]);

        DB::table('task_status')->insert([
            'name' => 'completed'
        ]);

        // Example tasks
        DB::table('task')->insert([
            'name' => 'Example task 1',
            'description' => 'Default task',
            'responsible_id' => 3, // Default Manager user
            'creator_id' => 1      // Default Admin user
        ]);

        DB::table('task')->insert([
            'name' => 'Example task 2',
            'description' => 'Task with due date',
            'due_date' => Carbon::create('2024', '01', '31'),
            'responsible_id' => 3, // Default Manager user
            'creator_id' => 1      // Default Admin user
        ]);

        DB::table('task')->insert([
            'name' => 'Example task 3',
            'description' => 'Task with due date and high priority',
            'due_date' => Carbon::create('2024', '01', '31'),
            'priority' => 3,
            'responsible_id' => 3, // Default Manager user
            'creator_id' => 1      // Default Admin user
        ]);
    }
}
