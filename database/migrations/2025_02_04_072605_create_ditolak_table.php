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
        Schema::create('ditolak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->text('alasan_penolakan');
            $table->unsignedBigInteger('ditolak_oleh');
            $table->timestamp('tanggal_ditolak')->useCurrent();
           

            // Foreign Keys
            $table->foreign('pengajuan_id')->references('id')->on('payment_mba')->onDelete('cascade');
            $table->foreign('ditolak_oleh')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ditolak');
    }
};
