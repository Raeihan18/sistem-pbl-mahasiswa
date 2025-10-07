<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'mahasiswa';

    // Primary key tabel
    protected $primaryKey = 'id_mahasiswa';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'id_kelompok',
        'email',
        'password',
    ];

    // Jika tidak ingin timestamps (created_at & updated_at)
    public $timestamps = false;

    // (Opsional) Sembunyikan password saat dikonversi ke array/JSON
    protected $hidden = [
        'password',
    ];
}