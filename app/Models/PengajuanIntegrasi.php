<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanIntegrasi extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'pengajuan_integrasi';
    protected $fillable = ['nama_pengajuan_integrasi'];


    protected $dates = ['deleted_at'];

    public function paymentMba()
    {
        return $this->hasMany(PaymentMba::class);
    }
}
