<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenggatPenilaian extends Model
{
    use HasFactory;

    protected $table = 'tenggat_penilaian';
    protected $primaryKey = 'id_tenggat';

    protected $fillable = [
        'tahun_ajaran',
        'tanggal_tenggat',
        'waktu_kirim_notif',

    ];
}