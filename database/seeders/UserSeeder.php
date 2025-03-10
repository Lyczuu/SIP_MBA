<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'dika@gmail.com',
                'username' => 'dika',
                'profile_image' => 'profile1.jpg',
                'role_id' => 1,
                'password' => Hash::make('111aaa'),
                'full_name' => 'Dika admin',
                'phone_number' => '08123456789',
                'alamat' => 'Jl. Admin No. 1',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'email' => 'kevin@gmail.com',
                'username' => 'kevin',
                'profile_image' => 'profile1.jpg',
                'role_id' => 2,
                'password' => Hash::make('222sss'),
                'full_name' => 'kevinn',
                'phone_number' => '08123986789',
                'alamat' => 'Jl. Am No. 1',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'email' => 'sandi@gmail.com',
                'username' => 'sandi',
                'profile_image' => 'profile1.jpg',
                'role_id' => 2,
                'password' => Hash::make('333ddd'),
                'full_name' => 'sandii',
                'phone_number' => '08123410789',
                'alamat' => 'Jl. Am No. 2',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'leon@gmail.com',
                'username' => 'leon',
                'profile_image' => 'profile1.jpg',
                'role_id' => 2,
                'password' => Hash::make('444fff'),
                'full_name' => 'leon stanger',
                'phone_number' => '08120456789',
                'alamat' => 'Jl. Am No. 3',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'adly@gmail.com',
                'username' => 'adly',
                'profile_image' => 'profile1.jpg',
                'role_id' => 2,
                'password' => Hash::make('555ggg'),
                'full_name' => 'adly rusly',
                'phone_number' => '0812489789',
                'alamat' => 'Jl. Am No. 4',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'email' => 'asep@gmail.com',
                'username' => 'asep',
                'profile_image' => 'profile1.jpg',
                'role_id' => 2,
                'password' => Hash::make('666hhh'),
                'full_name' => 'asepp',
                'phone_number' => '08123456789',
                'alamat' => 'Jl. Am No. 5',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
