<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'kelompok';

    // Primary key tabel
    protected $primaryKey = 'id_kelompok';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_kelompok',
    ];

    // Jika tidak ingin timestamps (created_at & updated_at)
    public $timestamps = false;

}