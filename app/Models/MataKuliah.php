<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'matkul';

    // Primary key tabel
    protected $primaryKey = 'id_matkul';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_matkul',
    ];

    // Jika tidak ingin timestamps (created_at & updated_at)
    public $timestamps = false;

}