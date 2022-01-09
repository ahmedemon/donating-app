<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'name'     => 'Admin',
                'username'      => 'admin',
                'email'          => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('admin'), // password
                'role_id' => 1,
            ]
        ]);
    }
}
