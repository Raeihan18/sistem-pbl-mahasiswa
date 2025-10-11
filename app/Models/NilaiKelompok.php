<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKelompok extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'nilai_kelompok';

    // Primary key tabel
    protected $primaryKey = 'id_nilai_kelompok';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_kelompok',
        'id_user',
        'id_matkul',
        'nilai_tugas',
        'nilai_project',
        'nilai_presentasi',
        'total_nilai',
        'nilai_kehadiran'
    ];

    // Jika tidak ingin timestamps (created_at & updated_at)
    public $timestamps = false;

}