<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mitra extends Model
{
    //
    use HasFactory;

    protected $table = 'mitra';
    protected $fillable = [
          'nama_mitra',
          'flag_agg',
          'flag_bank'];

    public function payments()
{
    return $this->hasMany(paymentmba::class, 'mitra_id');

}
}
