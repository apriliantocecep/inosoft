<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'tahun_keluaran' => $this->tahun_keluaran,
            'warna' => $this->warna,
            'harga' => $this->harga,
            'mesin' => $this->mesin,
            'tipe_suspensi' => $this->tipe_suspensi,
            'tipe_transmisi' => $this->tipe_transmisi,
            'kapasitas_penumpang' => $this->kapasitas_penumpang,
            'tipe' => $this->tipe,
            'jenis' => $this->jenis,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
