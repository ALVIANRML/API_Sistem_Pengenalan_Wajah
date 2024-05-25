<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftarWajah extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'daftar_wajah';
    protected $fillable =
    [
        'id',
        'kelas_id',
        'siswa_id',
    ];

    public function kelas(){
        return $this->hasMany(Kelas::class, 'kelas_id');
    }

    public function siswa(){
        return $this->hasMany(Siswa::class, 'siswa_id');
    }


    // public function siswa
}
