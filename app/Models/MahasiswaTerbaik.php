<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MahasiswaTerbaik extends Model
{

    use HasFactory;

    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'mahasiswa-terbaik';

    // Primary key tabel
    protected $primaryKey = 'id_mahasiswa_terbaik';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_mahasiswa',
        'IOT',
        'Keamanan Data',
        'Web Lanjut',
        'IT Project',
        'Partisipasi',
        'Hasil Proyek'
    ];
    
}
