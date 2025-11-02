<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Bobot extends Model
{
        // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'bobot';

    // Primary key tabel
    protected $primaryKey = 'id_bobot';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kriteria',
        'bobot',
        'tipe'
    ];
}
