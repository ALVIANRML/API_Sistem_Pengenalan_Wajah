<?php

namespace App\Http\Resources\Absen;

use App\Http\Resources\Kelas\KelasResource;
use App\Http\Resources\Siswa\SiswaResource;
use App\Http\Resources\Waktu\WaktuResource;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsenResource extends JsonResource
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
        $waktu = Waktu::where('id', $this->waktu_id)->first();
        return[
        'id' => $this->id,
        'kelas' => new KelasResource($kelas),
        'siswa' => new SiswaResource($siswa),
        'present'=> $this->present,
        'waktu' => new WaktuResource($waktu),
        'created_at' => $this->created_at,
         "updated_at" => $this-> updated_at,
        ];
    }
}
