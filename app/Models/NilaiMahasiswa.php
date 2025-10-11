<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai_mahasiswa';
    protected $primaryKey = 'id_nilai_mahasiswa';

    public $timestamps = false;

    protected $fillable = [
        'id_mahasiswa',
        'id_user',
        'nilai_tugas',
        'nilai_project',
        'nilai_presentasi',
        'nilai_kehadiran',
        'total_nilai',
        'id_matkul'
    ];

    

    // Hitung total_nilai otomatis sebelum save
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_nilai = (
                $model->nilai_tugas +
                $model->nilai_project +
                $model->nilai_presentasi +
                $model->nilai_kehadiran
            ) / 4;
        });
    }

    // Relasi opsional
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
