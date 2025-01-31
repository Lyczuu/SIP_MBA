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
        Schema::table('payment_mba', function (Blueprint $table) {
            //
            $table->string('Telepon_Payment_Mitra', 255);
            $table->string('Telepon_Rekon_Mitra', 255);
            $table->string('Telepon_Dinas', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_mba', function (Blueprint $table) {
            //
        });
    }
};
