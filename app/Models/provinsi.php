<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class provinsi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='provinsi';
    protected $fillable =[
        'nama_provinsi',
        'kode_prov'];

        protected $dates = ['deleted_at'];
}
