<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $fillable = ['total_harga', 'uang_bayar', 'uang_kembali'];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'transaksi_id');
    }
}
