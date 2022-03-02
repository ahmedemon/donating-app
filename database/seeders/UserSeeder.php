<?php

namespace Database\Seeders;

use App\Models\CurrentBalance;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'     => 'Ahmed Emon',
                'username'      => 'ahmedemon',
                'phone' => '01950594285',
                'gender' => 'Male',
                'email'          => 'ahmedemon@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('ahmedemon'), // password
                'remember_token' => Str::random(20),
                'is_active' => 1,
                'is_approve' => 1,
                'is_blocked' => 1,
                'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'     => 'John Doe',
                'username'      => 'johndoe',
                'phone' => '01950594286',
                'gender' => 'Male',
                'email'          => 'john@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('johndoe'), // password
                'remember_token' => Str::random(20),
                'is_active' => 0,
                'is_approve' => 0,
                'is_blocked' => 0,
                'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'     => 'Lorem Ipsum',
                'username'      => 'lorem',
                'phone' => '01950594287',
                'gender' => 'Male',
                'email'          => 'lorem@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('loremipsum'), // password
                'remember_token' => Str::random(20),
                'is_active' => 0,
                'is_approve' => 0,
                'is_blocked' => 0,
                'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'     => 'Dolor Sit',
                'username'      => 'dolorem',
                'phone' => '01950594288',
                'gender' => 'Male',
                'email'          => 'dolorem@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('dolorem'), // password
                'remember_token' => Str::random(20),
                'is_active' => 0,
                'is_approve' => 0,
                'is_blocked' => 0,
                'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
