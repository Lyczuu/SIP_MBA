<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenispajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_pajak')->insert([
            [
                'nama_jenis_pajak' => 'PBB INDIVIDU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_pajak' => 'PBB KOLEKTIF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_pajak' => 'BPHTB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_pajak' => 'PDL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_pajak' => 'RETRIBUSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],





        ]);
    }
}
