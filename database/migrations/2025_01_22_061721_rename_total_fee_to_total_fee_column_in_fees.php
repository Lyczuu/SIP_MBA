<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            // Mengubah nama kolom 'Total_Fee' menjadi 'total_fee'
            $table->renameColumn('Fee_mitra', 'fee_mitra');
            $table->renameColumn('Fee_mba', 'fee_mba');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            // Mengembalikan nama kolom ke 'Total_Fee' jika migration dibatalkan
            $table->renameColumn('fee_mitra', 'Fee_mitra');
            $table->renameColumn('fee_mba', 'Fee_mba');
        });
    }
};
