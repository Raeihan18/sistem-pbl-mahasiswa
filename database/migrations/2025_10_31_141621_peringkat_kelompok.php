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
    Schema::create('peringkat_kelompok', function (Blueprint $table) {
            $table->id('id_peringkat_kelompok');
            $table->unsignedBigInteger('id_kelompok');
            $table->decimal('nilai');
            $table->string('peringkat');

            $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok')->onDelete('cascade');

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('peringkat_kelompok');
    }
};
