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
            $table->decimal('Total_Fee', 15, 2)->default(0)->change();
            $table->decimal('Fee_mba', 15, 2)->default(0)->change();
            $table->decimal('Fee_mitra', 15, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            $table->decimal('Total_Fee', 15, 2)->default(null)->change();
            $table->decimal('Fee_mba', 15, 2)->default(null)->change();
            $table->decimal('Fee_mitra', 15, 2)->default(null)->change();
        });
    }
};
