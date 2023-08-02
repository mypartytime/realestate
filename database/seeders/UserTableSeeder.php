<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Admin',
                'username' => 'Admin Mike',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('555'),
                'role' => 'admin',
                'status' => 'active',
            ],
            // Agent
            [
                'name' => 'Agent',
                'username' => 'Agent Marry',
                'email' => 'agent@gmail.com',
                'password' => Hash::make('555'),
                'role' => 'agent',
                'status' => 'active',
            ],
            // User
            [
                'name' => 'User',
                'username' => 'User Jeff',
                'email' => 'user@gmail.com',
                'password' => Hash::make('555'),
                'role' => 'user',
                'status' => 'active',
            ],

        ]);
        
    }
}
