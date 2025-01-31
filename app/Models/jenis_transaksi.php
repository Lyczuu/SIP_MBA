<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jenis_transaksi extends Model
{
    //
    use HasFactory;

    protected $table = 'jenis_transaksi';
    protected $fillable = ['nama_jenis_transaksi'];


}
