<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fees extends Model
{
    //
    use HasFactory;

    protected $table = 'fees';
    protected $fillable = ['Total_Fee', 'Fee_mba', 'Fee_mitra'];

    //default value 0
    protected $attributes = [
        'Total_Fee' => 0,
        'Fee_mba' => 0,
        'Fee_mitra' => 0,
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
            $model->Total_Fee = $model->Total_Fee ?? 0;
            $model->Fee_mba = $model->Fee_mba ?? 0;
            $model->Fee_mitra = $model->Fee_mitra ?? 0;
        });
    }

}
