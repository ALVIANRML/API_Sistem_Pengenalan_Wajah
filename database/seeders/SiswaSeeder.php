<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = file_get_contents('C:\xampp\htdocs\API_sistem_pengenalan_wajah\database\seeders\sql\Siswa.sql');
        DB::insert($sql);
    }
}
