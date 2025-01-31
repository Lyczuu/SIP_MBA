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
            $table->json('jenis_pajak_id')->nullable(false);
            $table->unsignedBigInteger('fees_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('wilayah_id');
            $table->unsignedBigInteger('mitra_id');


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
