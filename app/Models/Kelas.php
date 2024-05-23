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
}
