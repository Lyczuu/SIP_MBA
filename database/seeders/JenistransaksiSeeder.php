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
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_transaksi' => 'VA',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_transaksi' => 'QRIS',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_transaksi' => 'AGGREGATOR',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
