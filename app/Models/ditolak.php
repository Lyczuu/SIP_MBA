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

    // Relasi ke tabel pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(paymentmba::class, 'pengajuan_id');
    }

    // Relasi ke tabel users (user yang menolak)
    public function ditolakOleh()
    {
        return $this->belongsTo(User::class, 'ditolak_oleh');
    }

}
