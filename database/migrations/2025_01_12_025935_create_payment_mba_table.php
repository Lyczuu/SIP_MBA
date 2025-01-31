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
        Schema::create('payment_mba', function (Blueprint $table) {
            $table->id();
            $table->char('Kode_pengajuan', 10);
            $table->string('Cutoff', 255);
            $table->string('Settlement', 255);
            $table->string('Pengajuan_integrasi', 255);
            $table->string('Nomor_Registrasi_Legal', 255);
            $table->string('WAG_KORDINASI_PAYMENT', 255);
            $table->string('WAG_KORDINASI_REKON', 255);
            $table->string('PIC_Payment_Mitra', 255);
            $table->string('PIC_Rekon_Mitra', 255);
            $table->string('PIC_Dinas', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_mba');

    }
};
