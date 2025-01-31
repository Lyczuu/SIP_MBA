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
            $table->renameColumn('Kode_pengajuan', 'kode_pengajuan');
            $table->renameColumn('Settlement', 'settlement');
            $table->renameColumn('Pengajuan_integrasi', 'pengajuan_integrasi');
            $table->renameColumn('Cutoff', 'cutoff');
            $table->renameColumn('Nomor_Registrasi_Legal', 'nomor_registrasi_legal');
            $table->renameColumn('WAG_KORDINASI_PAYMENT', 'wag_kordinasi_payment');
            $table->renameColumn('WAG_KORDINASI_REKON', 'wag_kordinasi_rekon');
            $table->renameColumn('PIC_Payment_Mitra', 'pic_payment_mitra');
            $table->renameColumn('PIC_Rekon_Mitra', 'pic_rekon_mitra');
            $table->renameColumn('PIC_Dinas', 'pic_dinas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_mba', function (Blueprint $table) {
            $table->renameColumn('kode_pengajuan', 'Kode_pengajuan');
            $table->renameColumn('settlement', 'Settlement');
            $table->renameColumn('pengajuan_integrasi', 'Pengajuan_integrasi');
            $table->renameColumn('cutoff', 'Cutoff');
            $table->renameColumn('nomor_registrasi_legal', 'Nomor_Registrasi_Legal');
            $table->renameColumn('wag_kordinasi_payment', 'WAG_KORDINASI_PAYMENT');
            $table->renameColumn('wag_kordinasi_rekon', 'WAG_KORDINASI_REKON');
            $table->renameColumn('pic_payment_mitra', 'PIC_Payment_Mitra');
            $table->renameColumn('pic_rekon_mitra', 'PIC_Rekon_Mitra');
            $table->renameColumn('pic_dinas', 'PIC_Dinas');
        });
    }
};
