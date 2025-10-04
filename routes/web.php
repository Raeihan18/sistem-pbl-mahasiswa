<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ControllerMahasiswa;
use App\http\Controllers\User;
use App\http\Controllers\ControllerNilaiMahasiswa;

Route::get('/', function () {
    return view('welcome');
});

//Route Mahasiswa
Route::get('/dosen/mahasiswa',[ControllerMahasiswa::class, 'index']);
Route::get('/dosen/mahasiswa/create',[ControllerMahasiswa::class, 'create']);
Route::get('/dosen/mahasiswa/store',[ControllerMahasiswa::class, 'store']);
Route::get('/dosen/mahasiswa/edit',[ControllerMahasiswa::class, 'edit']);
Route::get('/dosen/mahasiswa/update',[ControllerMahasiswa::class, 'update']);
Route::get('/dosen/mahasiswa/delete',[ControllerMahasiswa::class, 'delete']);

//Route User
Route::get('/dosen/mahasiswa',[ControllerUser::class, 'index']);
Route::get('/dosen/mahasiswa/create',[ControllerUser::class, 'create']);
Route::get('/dosen/mahasiswa/store',[ControllerUser::class, 'store']);
Route::get('/dosen/mahasiswa/edit',[ControllerUser::class, 'edit']);
Route::get('/dosen/mahasiswa/update',[ControllerUser::class, 'update']);
Route::get('/dosen/mahasiswa/delete',[ControllerUser::class, 'delete']);

//Route Nilai Mahasiswa
Route::get('/dosen/mahasiswa',[ControllerNilaiMahasiswa::class, 'index']);
Route::get('/dosen/mahasiswa/create',[ControllerNilaiMahasiswa::class, 'create']);
Route::get('/dosen/mahasiswa/store',[ControllerNilaiMahasiswa::class, 'store']);
Route::get('/dosen/mahasiswa/edit',[ControllerNilaiMahasiswa::class, 'edit']);
Route::get('/dosen/mahasiswa/update',[ControllerNilaiMahasiswa::class, 'update']);
Route::get('/dosen/mahasiswa/delete',[ControllerNilaiMahasiswa::class, 'delete']);
