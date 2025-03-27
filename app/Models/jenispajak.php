<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenispajak extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'jenis_pajak';
    protected $fillable = [
        'nama_jenis_pajak',
        'status'
    ];

    protected $dates = ['deleted_at'];

    public function paymentMba()
    {
        return $this->hasMany(PaymentMba::class, 'jenis_pajak_id');
    }
}
