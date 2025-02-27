<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinsi')->insert([
            ['kode_prov' => '11', 'nama_provinsi' => 'Aceh', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '12', 'nama_provinsi' => 'Sumatera Utara', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '13', 'nama_provinsi' => 'Sumatera Barat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '14', 'nama_provinsi' => 'Riau', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '15', 'nama_provinsi' => 'Jambi', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '16', 'nama_provinsi' => 'Sumatera Selatan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '17', 'nama_provinsi' => 'Bengkulu', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '18', 'nama_provinsi' => 'Lampung', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '19', 'nama_provinsi' => 'Kepulauan Bangka Belitung', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '21', 'nama_provinsi' => 'Kepulauan Riau', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '31', 'nama_provinsi' => 'DKI Jakarta', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '32', 'nama_provinsi' => 'Jawa Barat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '33', 'nama_provinsi' => 'Jawa Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '34', 'nama_provinsi' => 'DI Yogyakarta', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '35', 'nama_provinsi' => 'Jawa Timur', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '36', 'nama_provinsi' => 'Banten', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '51', 'nama_provinsi' => 'Bali', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '52', 'nama_provinsi' => 'Nusa Tenggara Barat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '53', 'nama_provinsi' => 'Nusa Tenggara Timur', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '61', 'nama_provinsi' => 'Kalimantan Barat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '62', 'nama_provinsi' => 'Kalimantan Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '63', 'nama_provinsi' => 'Kalimantan Selatan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '64', 'nama_provinsi' => 'Kalimantan Timur', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '65', 'nama_provinsi' => 'Kalimantan Utara', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '71', 'nama_provinsi' => 'Sulawesi Utara', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '72', 'nama_provinsi' => 'Sulawesi Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '73', 'nama_provinsi' => 'Sulawesi Selatan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '74', 'nama_provinsi' => 'Sulawesi Tenggara', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '75', 'nama_provinsi' => 'Gorontalo', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '76', 'nama_provinsi' => 'Sulawesi Barat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '81', 'nama_provinsi' => 'Maluku', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '82', 'nama_provinsi' => 'Maluku Utara', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '91', 'nama_provinsi' => 'Papua Barat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '92', 'nama_provinsi' => 'Papua Barat Daya', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '94', 'nama_provinsi' => 'Papua', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '95', 'nama_provinsi' => 'Papua Selatan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '96', 'nama_provinsi' => 'Papua Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_prov' => '97', 'nama_provinsi' => 'Papua Pegunungan', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
