<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $fillable = ['produk_id', 'jumlah', 'transaksi_id'];

    public function produks()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function transaksis()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
