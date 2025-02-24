<?php

namespace Database\Seeders;

use App\Models\mitra;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mitra::create([
            'nama_mitra' => 'BANK SUMSEL BABEL',
            'flag_agg' => '0',
            'flag_bank' => '0',
        ]);
    }
}
