<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Resources\TransaksiResource;

class TransaksiController extends Controller
{

    public function index()
    {
        $transaksis = TransaksiResource::collection(Transaksi::all());

        return response()->json([
            'transaksis' => $transaksis,
        ], 200);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $transaksi = Transaksi::create($request->validate([
            'total_harga' => 'required',
            'uang_bayar' => 'required',
            'uang_kembali' => 'required',
        ]));

        //sample code untuk create pesanan
        $data = [
            [
                'produk_id' => '1',
                'jumlah' => '2',
            ],
            [
                'produk_id' => '2',
                'jumlah' => '2',
            ],
            [
                'produk_id' => '3',
                'jumlah' => '2',
            ]
        ];
        $pesanans = collect($data)->map(function ($item) use ($transaksi) {
            $item['transaksi_id'] = $transaksi->id;
            return $item;
        });
        $pesanan = Pesanan::insert($pesanans->toArray());
        $harga = collect($data)->map(function ($item) {
            $produk = Produk::find($item['produk_id']);
            return $produk->harga * $item['jumlah'];
        });
        $total = $harga->sum();
        $transaksi = Transaksi::with('pesanans')->find($transaksi->id);
        return response()->json([
            'transaksi' => $transaksi,
        ], 200);
    }


    public function show(Transaksi $transaksi)
    {
        //
        $transaksi = Transaksi::find($transaksi->id);

        $pesanan = $transaksi->pesanan;
        $pesanan = $pesanan->map(function ($item) {
            $produk = Produk::find($item['produk_id']);
            $item['nama_produk'] = $produk->nama_produk;
            $item['harga'] = $produk->harga;
            $item['total_harga'] = $produk->harga * $item['jumlah'];
            return $item;
        });

        return response()->json([
            'transaksi' => $transaksi,

        ], 200);
    }


    public function edit(Transaksi $transaksi)
    {
        //
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        //
        $transaksi->update($request->validate([
            'total_harga' => 'required',
            'uang_bayar' => 'required',
            'uang_kembali' => 'required',
        ]));
    }

    public function destroy(Transaksi $transaksi)
    {
        //
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $transaksi->delete();
    }
}
