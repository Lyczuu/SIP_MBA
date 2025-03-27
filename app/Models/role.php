<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class role extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
        "nama_role",
        "keterangan"
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role', 'nama_role');
    }
}
