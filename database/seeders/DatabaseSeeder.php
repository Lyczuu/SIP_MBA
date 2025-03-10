<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MitraSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\WilayahSeeder;
use Database\Seeders\ProvinsiSeeder;
use Database\Seeders\JenispajakSeeder;
use Database\Seeders\JenistransaksiSeeder;
use Database\Seeders\PengajuanintegrasiSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(JenispajakSeeder::class);
        $this->call(JenistransaksiSeeder::class);
        $this->call(MitraSeeder::class);
        $this->call(PengajuanintegrasiSeeder::class);
        $this->call(ProvinsiSeeder::class);
        $this->call(WilayahSeeder::class);
    }

}
