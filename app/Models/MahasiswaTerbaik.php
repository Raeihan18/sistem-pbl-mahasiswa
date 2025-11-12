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
        'iot',
        'keamanan_data',
        'web_lanjut',
        'it_project',
        'partisipasi',
        'hasil_proyek',
        'total_nilai'
    ];

        public function mahasiswa()
{
    return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
}
    
}
