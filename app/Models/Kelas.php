<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'kelas';
    protected $fillable = [
        'name',
        'semester'
    ];

    public function absen(){
        return $this->belongsTo(absen::class, 'absen_id');
    }
    public function daftarWajah(){
        return $this->belongsTo(daftarWajah::class, 'daftar_wajah_id');
    }
}
