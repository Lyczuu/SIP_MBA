<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymentmba extends Model
{
    //
    protected $table = 'payment_mba';
    protected $fillable = [
        'user_id',
        'kode_pengajuan', // Tambahkan ini
        'transaksi_id',
        'jenis_pajak_id',
        'wilayah_id',
        'fees_id',
        'mitra_id',
        'pengajuan_integrasi_id',
        'jenis_pengajuan',
        'mitra_agg',
        'cutoff',
        'status',
        'settlement',
        'nomor_registrasi_legal',
        'wag_kordinasi_payment',
        'wag_kordinasi_rekon',
        'pic_payment_mitra',
        'telepon_payment_mitra',
        'pic_rekon_mitra',
        'telepon_rekon_mitra',
        'pic_dinas',
        'telepon_dinas',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenis_pajak()
    {
        return $this->belongsTo(Jenis_Pajak::class, 'jenis_pajak_id');
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


    public function ditolak()
    {
        return $this->belongsTo(ditolak::class, 'pengajuan_id', 'id');
    }


    public function pengajuanIntegrasi()
{
    return $this->belongsTo(PengajuanIntegrasi::class, 'pengajuan_integrasi_id');
}

}
