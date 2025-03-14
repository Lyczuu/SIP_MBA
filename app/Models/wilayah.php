<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class wilayah extends Model
{
    //
    use HasFactory;

    protected $table = 'wilayah';
    protected $fillable = ['nama_wilayah','kode_prov', 'kode_area'];

    public function payments()
    {
        return $this->hasMany(paymentMba::class, 'wilayah_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_wilayah', 'wilayah_id', 'user_id');
    }


    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_prov', 'kode_prov');
    }

}
