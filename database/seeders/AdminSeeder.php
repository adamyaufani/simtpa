<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'email' => 'admin@site.com',
            'password' => bcrypt('pass'),
            'fullname' => 'admin',
            'phone' => '123456789',
            'role_id' => 1,
        ]);

        DB::table('admins')->insert([
            'username' => 'admin2',
            'email' => 'admin2@site.com',
            'password' => bcrypt('pass'),
            'fullname' => 'admin2',
            'phone' => '123456789',
            'role_id' => 1,
        ]);

        DB::table('admins')->insert([
            'username' => 'admin3',
            'email' => 'admin3@site.com',
            'password' => bcrypt('pass'),
            'fullname' => 'admin3',
            'phone' => '123456789',
            'role_id' => 1,
        ]);
    }
}
