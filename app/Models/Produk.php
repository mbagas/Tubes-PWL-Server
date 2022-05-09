<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = ['nama_produk', 'harga'];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'produk_id');
    }
}
