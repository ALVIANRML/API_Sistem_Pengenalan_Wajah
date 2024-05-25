<?php

namespace App\Http\Resources\Siswa;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'    => $this -> id,
            'nama'  => $this -> nama,
            'nim'   => $this -> nim,
            'gambar'=> $this -> gambar,
        ];

    }
}
