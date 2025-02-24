<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanIntegrasi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'pengajuan_integrasi';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['nama_pengajuan_integrasi'];

    // Relasi One-to-Many dengan PaymentMba

    public function paymentMba()
{
    return $this->hasMany(PaymentMba::class);
}

}
