<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenistransaksi extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'jenis_transaksi';
    protected $fillable = ['nama_jenis_transaksi'];

    protected $dates = ['deleted_at'];

}
