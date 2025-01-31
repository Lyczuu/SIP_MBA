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
            $table->renameColumn('Total_Fee', 'total_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            // Mengembalikan nama kolom ke 'Total_Fee' jika migration dibatalkan
            $table->renameColumn('total_fee', 'Total_Fee');
        });
    }
};
