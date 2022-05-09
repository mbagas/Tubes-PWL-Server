<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource;

class ProdukController extends Controller
{

    public function index()
    {

        $produks = ProdukResource::collection(Produk::all());

        return response()->json([
            'produks' => $produks,
        ], 200);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $produk = Produk::create($request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
        ]));
        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'produk' => new ProdukResource($produk),
        ], 201);
    }

    public function show(Produk $produk)
    {

        return response()->json([
            'produk' => new ProdukResource($produk),
        ], 200);
    }


    public function edit(Produk $produk)
    {
    }

    public function update(Request $request, Produk $produk)
    {
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $produk->update($request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
        ]));

        $produk->nama_produk = $request['nama_produk'];
        $produk->harga = $request['harga'];
        $produk->save();

        return response()->json([
            'message' => 'Produk berhasil diubah',
            'produk' => new ProdukResource($produk),
        ], 200);
    }


    public function destroy(Produk $produk)
    {
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $produk->delete();
    }
}
