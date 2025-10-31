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
    Schema::create('nilai_kelompok', function (Blueprint $table) {
            $table->id('id_nilai_kelompok');
            $table->unsignedBigInteger('id_kelompok');
            $table->unsignedBigInteger('id_matkul');
            $table->unsignedBigInteger('id_user');
            $table->decimal('nilai_tugas', 10, 2);
            $table->decimal('nilai_project', 10, 2);
            $table->decimal('nilai_presentasi', 10, 2);
            $table->decimal('nilai_kehadiran', 10, 2);
            $table->decimal('total_nilai', 10, 2);
            $table->integer('Pertemuan');

            $table->timestamps();
            $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok')->onDelete('cascade');
            $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_kelompok');
    }
};
