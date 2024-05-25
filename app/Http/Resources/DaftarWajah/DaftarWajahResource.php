<?php

namespace App\Http\Resources\DaftarWajah;

use App\Http\Resources\Kelas\KelasResource;
use App\Http\Resources\Siswa\SiswaResource;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DaftarWajahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $kelas = Kelas::where('id', $this->kelas_id)->first();
        $siswa = Siswa::where('id', $this->siswa_id)->first();
        return[
            'id'    => $this->id,
            'kelas' => new KelasResource($kelas),
            'siswa' => new SiswaResource($siswa),
            
        ];
    }
}
