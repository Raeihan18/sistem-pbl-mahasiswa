<?php


namespace App\Models;
use App\Models\MataKuliah;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'nama',
        'email',
        'no_wa',
        'password',
    ];
    public $timestamps = false;
    protected $hidden = [
        'password',
    ];


public function matkul()
{
    return $this->belongsToMany(MataKuliah::class, 'detail_matkul_dosen', 'id_user', 'id_matkul')->withTimestamps();
}
}
