<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fees extends Model
{
    //
    use HasFactory;

    protected $table = 'fees';
    protected $fillable = ['total_fee', 'fee_mba', 'fee_mitra'];

    //default value 0
    protected $attributes = [
        'total_fee' => 0,
        'fee_mba' => 0,
        'fee_mitra' => 0,
    ];


    public function payment()
    {
        return $this->hasMany(PaymentMba::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Menjamin untuk nilai default diterapkan jika tidak ada nilai yang diberikan
            $model->total_fee = $model->total_fee ?? 0;
            $model->fee_mba = $model->fee_mba ?? 0;
            $model->fee_mitra = $model->fee_mitra ?? 0;
        });
    }

}
