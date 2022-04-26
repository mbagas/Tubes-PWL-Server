<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'total_harga' => $this->total_harga,
            'uang_bayar' => $this->uang_bayar,
            'uang_kembali' => $this->uang_kembali,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
