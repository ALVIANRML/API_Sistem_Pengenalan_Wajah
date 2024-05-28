<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('siswa_id')->nullable();
            $table->uuid('kelas_id')->nullable();
            $table->boolean('present')->default(false)->nullable();
            $table->uuid('waktu_id')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')
            ->references('id')
            ->on('kelas')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('siswa_id')
            ->references('id')
            ->on('siswa')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('waktu_id')
            ->references('id')
            ->on('waktu')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen');
    }
};
