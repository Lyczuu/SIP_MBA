<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengajuanintegrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengajuan_integrasi')->insert([
            [
                'nama_pengajuan_integrasi' => 'DEVELOPMENT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengajuan_integrasi' => 'SIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pengajuan_integrasi' => 'UAT',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
