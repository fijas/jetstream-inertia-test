<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => "admin@admin.com",
            'password' => '$2y$10$hXBW./do9C6ACvkUzG2U5eRuD.KdLTSdFNrGpxlC15Xb7oRj0ZYCK'
        ]);
    }
}
