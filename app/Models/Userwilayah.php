<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userwilayah extends Model
{
    use HasFactory;
    protected $table = 'user_wilayah';
    protected $fillable =[
        'user_id',
        'wilayah_id'];

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

        public function wilayah()
        {
            return $this->belongsTo(Wilayah::class, 'wilayah_id');
        }
}
