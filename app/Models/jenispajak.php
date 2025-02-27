<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jenispajak extends Model
{
    use HasFactory;

    protected $table = 'jenis_pajak';
    protected $fillable = ['nama_jenis_pajak'];

    public function paymentMba()
    {
        return $this->hasMany(PaymentMba::class, 'jenis_pajak_id');
    }
}
