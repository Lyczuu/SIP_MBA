<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenistransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_transaksi')->insert([
            [
                'nama_jenis_transaksi' => 'H2H',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_transaksi' => 'VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_transaksi' => 'QRIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_transaksi' => 'AGGREGATOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
