<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role extends Model
{
    //
    use HasFactory;
     protected $table = 'roles';
     protected $fillable =[
        "nama_role",
        "keterangan"
     ];
     public function users()
{
    return $this->hasMany(User::class, 'role_id');
}
}
