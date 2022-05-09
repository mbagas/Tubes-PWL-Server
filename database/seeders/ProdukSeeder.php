<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $produk = [
            [
                'nama_produk' => 'Kopi',
                'harga' => '10000',
            ],
            [
                'nama_produk' => 'Teh',
                'harga' => '5000',
            ],
            [
                'nama_produk' => 'Jus',
                'harga' => '15000',
            ]
        ];
        Produk::insert($produk);
    }
}
