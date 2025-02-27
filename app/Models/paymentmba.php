<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymentmba extends Model
{
    //
    protected $table = 'payment_mba';
    protected $fillable = [
        'user_id',
        'kode_pengajuan',
        'transaksi_id',
        'pengajuan_integrasi_id',
        'jenis_pajak_id',
        'wilayah_id',
        'fees_id',
        'mitra_id',
        'mitra_agg',
        'status',
        'jenis_pengajuan',
        'cutoff',
        'settlement',
        'nomor_registrasi_legal',
        'pic_payment_mitra',
        'pic_rekon_mitra',
        'pic_dinas',
        'telepon_payment_mitra',
        'telepon_rekon_mitra',
        'telepon_dinas',
        'wag_kordinasi_payment',
        'wag_kordinasi_rekon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenisPajak()
    {
        return $this->belongsTo(jenispajak::class, 'jenis_pajak_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fees_id');
    }

    public function jenis_transaksi()
    {
        return $this->belongsTo(jenistransaksi::class, 'transaksi_id');
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
        return $this->hasOne(Ditolak::class, 'pengajuan_id', 'id');
    }

    public function pengajuanIntegrasi()
    {
        return $this->belongsTo(PengajuanIntegrasi::class, 'pengajuan_integrasi_id', 'id');
    }

}
