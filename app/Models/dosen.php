<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'dosen';
    protected $fillable = [
        'name',
        'nip',
    ];

    public function daftarWajah(){
        return $this->belongsTo(daftarWajah::class, 'daftarWajah_id');
    }
}
