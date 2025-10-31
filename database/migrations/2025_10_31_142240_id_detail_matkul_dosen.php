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
    Schema::create('detail_matkul_dosen', function (Blueprint $table) {
            $table->id('id_detail_matkul_dosen');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_matkul');


            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('detail_matkul_dosen');
    }
};
