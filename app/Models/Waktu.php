<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'waktu';
    protected $fillable = [
        'waktu_awal',
        'range',
        'waktu_akhir',
    ];
}
