<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class mitra extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'mitra';
    protected $fillable = [
        'nama_mitra',
        'flag_agg',
        'flag_bank'
    ];

    protected $dates = ['deleted_at'];


    public function payments()
    {
        return $this->hasMany(paymentmba::class, 'mitra_id');
    }
}
