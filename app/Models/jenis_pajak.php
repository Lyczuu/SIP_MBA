<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pajak extends Model
{
    //
    use HasFactory;

    protected $table = 'jenis_pajak';
    protected $fillable = ['nama_jenis_pajak'];

    public function paymentMbas()
    {
        return $this->hasMany(PaymentMba::class, 'jenis_pajak_id');
    }

}
