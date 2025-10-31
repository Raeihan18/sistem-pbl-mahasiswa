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
    Schema::create('profil', function (Blueprint $table) {
            $table->id('id_profil');
            $table->unsignedBigInteger('id_user');
            $table->string('matakuliah');
            $table->string('potoprofil');
            $table->string('NIP');

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('profil');
    }
};
