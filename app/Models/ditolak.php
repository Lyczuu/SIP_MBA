<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ditolak extends Model
{
    use HasFactory;

    protected $table =  'ditolak';
    protected $fillable = [
        'pengajuan_id',
        'alasan_penolakan',
        'ditolak_oleh',
        'tanggal_ditolak',
    ];

    protected $dates = ['tanggal_ditolak'];

    public function paymentMba()
    {
        return $this->belongsTo(PaymentMba::class, 'pengajuan_id', 'id');
    }


    // Relasi ke tabel users (user yang menolak)
    public function ditolakOleh()
    {
        return $this->belongsTo(User::class, 'ditolak_oleh');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ditolak_oleh');
    }
}
