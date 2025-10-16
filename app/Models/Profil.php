<?php


namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profil extends Model
{
    use HasFactory;


    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'profil';


    // Primary key tabel
    protected $primaryKey = 'id_profil';


    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_user',
        'id_matkul',
        'potoprofil',
        'NIP',
    ];


    // Jika tidak ingin timestamps (created_at & updated_at)
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
