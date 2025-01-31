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
            // $table->foreign('jenis_pajak_id')->references('id')->on('jenis_pajak')->onDelete('cascade');
            $table->foreign('fees_id')->references('id')->on('fees')->onDelete('cascade');
            $table->foreign('transaksi_id')->references('id')->on('jenis_transaksi')->onDelete('cascade');
            $table->foreign('wilayah_id')->references('id')->on('wilayah')->onDelete('cascade');
            $table->foreign('mitra_id')->references('id')->on('mitra')->onDelete('cascade');
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
