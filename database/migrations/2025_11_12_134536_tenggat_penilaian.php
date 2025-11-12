<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenggat_penilaian', function (Blueprint $table) {
            $table->id('id_tenggat');
            $table->string('tahun_ajaran', 20);
            $table->dateTime('tanggal_tenggat');
            $table->dateTime('waktu_kirim_notif')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenggat_penilaian');
    }
};