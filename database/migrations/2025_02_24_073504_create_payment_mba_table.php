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
            $table->char('kode_pengajuan', 10);
            $table->time('cutoff');
            $table->time('settlement');
            $table->string('nomor_registrasi_legal', 255);
            $table->string('wag_kordinasi_payment', 255);
            $table->string('wag_kordinasi_rekon', 255);
            $table->string('pic_payment_mitra', 255);
            $table->string('pic_rekon_mitra', 255);
            $table->string('pic_dinas', 255);
            $table->string('jenis_pajak_id', 255);
            $table->unsignedBigInteger('fees_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('wilayah_id');
            $table->unsignedBigInteger('mitra_id');
            $table->unsignedBigInteger('pengajuan_integrasi_id');
            $table->unsignedBigInteger('user_id')->nullable(); // Letakkan setelah kolom 'id'
            $table->string('telepon_payment_mitra', 255);
            $table->string('telepon_rekon_mitra', 255);
            $table->string('telepon_dinas', 255);
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('mitra_agg')->nullable(); // Tipe data diperbaiki
            $table->string('jenis_pengajuan', 255);


            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('fees_id')->references('id')->on('fees')->onDelete('cascade');

            $table->foreign('transaksi_id')->references('id')->on('jenis_transaksi')->onDelete('restrict');
            $table->foreign('wilayah_id')->references('id')->on('wilayah')->onDelete('restrict');

            $table->foreign('mitra_id')->references('id')->on('mitra')->onDelete('restrict');
            $table->foreign('mitra_agg')->references('id')->on('mitra')->onDelete('restrict'); // Tambahkan ini

            $table->foreign('pengajuan_integrasi_id')->references('id')->on('pengajuan_integrasi')->onDelete('restrict');
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
