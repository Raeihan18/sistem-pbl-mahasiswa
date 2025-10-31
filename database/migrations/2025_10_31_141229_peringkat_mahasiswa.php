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
     Schema::create('peringkat_mahasiswa', function (Blueprint $table) {
            $table->id('id_peringkat_mahasiswa');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->decimal('nilai');
            $table->string('peringkat');

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('peringkat_mahasiswa');
    }
};
