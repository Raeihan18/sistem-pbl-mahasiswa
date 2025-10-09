<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ControllerMahasiswa;
use App\http\Controllers\ControllerUser;
use App\http\Controllers\ControllerNilaiMahasiswa;

Route::get('/', function () {
    return view('welcome');
});

//Route Mahasiswa
Route::get('/dosen/mahasiswa',[ControllerMahasiswa::class, 'index']);
Route::get('/dosen/mahasiswa/create',[ControllerMahasiswa::class, 'create']);
Route::post('/dosen/mahasiswa/store',[ControllerMahasiswa::class, 'store']);
Route::get('/dosen/mahasiswa/edit/{id_mahasiswa}',[ControllerMahasiswa::class, 'edit']);
Route::post('/dosen/mahasiswa/update/{id_mahasiswa}',[ControllerMahasiswa::class, 'update']);
Route::get('/dosen/mahasiswa/delete/{id_mahasiswa}',[ControllerMahasiswa::class, 'delete']);

//Route User
Route::get('/dosen/user',[ControllerUser::class, 'index']);
Route::get('/dosen/user/create',[ControllerUser::class, 'create']);
Route::post('/dosen/user/store',[ControllerUser::class, 'store']);
Route::get('/dosen/user/edit/{id_user}',[ControllerUser::class, 'edit']);
Route::post('/dosen/user/update/{id_user}',[ControllerUser::class, 'update']);
Route::get('/dosen/user/delete/{id_user}',[ControllerUser::class, 'delete']);

//Route Nilai Mahasiswa
Route::get('/dosen/nilai-mahasiswa',[ControllerNilaiMahasiswa::class, 'index']);
Route::get('/dosen/nilai-mahasiswa/create',[ControllerNilaiMahasiswa::class, 'create']);
Route::post('/dosen/nilai-mahasiswa/store',[ControllerNilaiMahasiswa::class, 'store']);
Route::get('/dosen/nilai-mahasiswa/edit/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswa::class, 'edit']);
Route::post('/dosen/nilai-mahasiswa/update/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswa::class, 'update']);
Route::get('/dosen/nilai-mahasiswa/delete/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswa::class, 'delete']);
