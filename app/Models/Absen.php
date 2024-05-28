<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'absen';
    protected $fillable = ['kelas_id', 'siswa_id', 'present','waktu_id'];

    // public $incrementing = false;
    protected $keyType = 'string';

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

}
