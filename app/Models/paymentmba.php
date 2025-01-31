<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymentmba extends Model
{
    //
    protected $table = 'payment_mba';
    protected $fillable = [
        'wilayah_id',
        'mitra_id',
        'Kode_pengajuan', // Tambahkan ini
        'Pengajuan_integrasi',
        'mitra_agg',
        'Cutoff',
        'Settlement',
        'Nomor_Registrasi_Legal',
        'PIC_Payment_Mitra',
        'telepon_payment_mitra',
        'PIC_Rekon_Mitra',
        'telepon_rekon_mitra',
        'PIC_Dinas',
        'telepon_dinas',
        'transaksi_id',
        'WAG_KORDINASI_PAYMENT',
        'WAG_KORDINASI_REKON',
        'jenis_pajak_id',
        'fees_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function jenisPajak()
    {
        return $this->belongsTo(jenis_pajak::class, 'jenis_pajak_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fees_id');
    }

    public function jenis_transaksi()
    {
        return $this->belongsTo(jenis_transaksi::class, 'transaksi_id');
    }
    public function mitra()
    {
        return $this->belongsTo(mitra::class, 'mitra_id');
    }
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }
}
