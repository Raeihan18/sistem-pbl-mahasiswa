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
            Schema::create('mahasiswa-terbaik', function (Blueprint $table) {
            $table->id('id_mahasiswa_terbaik');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->decimal('IOT', 10, 2);
            $table->decimal('Keamanan Data', 10, 2);
            $table->decimal('Web Lanjut', 10, 2);
            $table->decimal('IT Project', 10, 2);
            $table->decimal('Partisipasi', 10, 2);
            $table->decimal('Hasil Proyek', 10, 2);
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');


    });     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('mahasiswa-terbaik');
    }
};
