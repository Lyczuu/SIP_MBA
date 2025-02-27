<?php

namespace Database\Seeders;

use App\Models\mitra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mitra')->insert([
            ['nama_mitra' => 'BANK SUMSEL BABEL', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK NTT', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK BJB', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK KALTIMTARA', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK JAMBI', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK NTB', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK SULTRA', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK BNI', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK BRI', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'ALFAMART', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'ALFAMIDI', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK KALTENG', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK JATIM', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK MANDIRI', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK NAGARI', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'INDOMARET', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'PT POS', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'TOKOPEDIA', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK PAPUA', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'TOKOPEDIA VIA BANK SUMSEL', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'ALFAMART VIA NTT', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'INDOMARET VIA NTT', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK BTN', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'BANK BENGKULU', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mitra' => 'ESPAY', 'flag_agg' => '0', 'flag_bank' => '0', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
