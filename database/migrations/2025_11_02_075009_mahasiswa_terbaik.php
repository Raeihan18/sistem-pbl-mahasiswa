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
            $table->decimal('iot', 10, 2);
            $table->decimal('keamanan_data', 10, 2);
            $table->decimal('web_lanjut', 10, 2);
            $table->decimal('it_project', 10, 2);
            $table->decimal('total_nilai', 10, 2);
            $table->decimal('partisipasi', 10, 2);
            $table->decimal('hasil_proyek', 10, 2);
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
