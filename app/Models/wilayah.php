<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class wilayah extends Model
{
    //
    use HasFactory;

    protected $table = 'wilayah';
    protected $fillable = ['nama_wilayah'];

    public function payments()
{
    return $this->hasMany(paymentMba::class, 'wilayah_id');
    
}

}
