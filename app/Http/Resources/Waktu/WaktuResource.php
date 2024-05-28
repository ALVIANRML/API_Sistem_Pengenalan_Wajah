<?php

namespace App\Http\Resources\Waktu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WaktuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id'            => $this-> id,
            'waktu_awal'    => $this-> waktu_awal,
            'range'         => $this-> range,
            'waktu_akhir'  => $this-> waktu_akhir,
        ];
    }
}
