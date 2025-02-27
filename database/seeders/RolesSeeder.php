<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
            [
                'nama_role' => 'Admin',
                'keterangan' => 'Saya Bekerja Sebagai Admin ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'AM Wilayah',
                'keterangan' => 'Saya Bekerja Sebagai AM Wilayah',
                'created_at' => now(),
                'updated_at' => now(),
            ],




        ]);
    }
}
