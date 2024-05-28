<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'siswa';
    protected $fillable = [
        'nama',
        'nim',
        'gambar',
    ];

    public function daftarWajah(){
        return $this->belongsTo(daftarWajah::class, 'daftarWajah_id');
    }

    public function absen(){
        return $this->belongsTo(absen::class, 'absen_id');
    }
}
