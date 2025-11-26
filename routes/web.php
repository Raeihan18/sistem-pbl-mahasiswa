<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ControllerMahasiswa;
use App\http\Controllers\ControllerKaprodi;
use App\http\Controllers\ControllerUser;
use App\http\Controllers\ControllerNilaiMahasiswa;
use App\http\Controllers\ControllerMataKuliah;
use App\http\Controllers\ControllerKelompok;
use App\http\Controllers\ControllerNilaiKelompok;
use App\http\Controllers\ControllerDashboard;
use App\http\Controllers\ControllerProfil;
use App\http\Controllers\ControllerUserMahasiswa;
use App\http\Controllers\ControllerAuth;
use App\http\Controllers\ControllerPembimbing;
use App\http\Controllers\Admin\ControllerDashboardAdmin;
use App\http\Controllers\Admin\ControllerKelompokAdmin;
use App\http\Controllers\Admin\ControllerMahasiswaAdmin;
use App\http\Controllers\Admin\ControllerMataKuliahAdmin;
use App\http\Controllers\Admin\ControllerNilaiMahasiswaAdmin;
use App\http\Controllers\Admin\ControllerNilaiKelompokAdmin;
use App\http\Controllers\Admin\ControllerUserAdmin;
use App\http\Controllers\Admin\ControllerTpk;
use App\http\Controllers\Admin\ControllerTenggatPenilaian;



// Halaman login
Route::get('/', function(){
   return redirect('/login');
});
Route::get('/login', [ControllerAuth::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [ControllerAuth::class, 'login'])->name('login.submit');

// Logout
Route::get('/logout', [ControllerAuth::class, 'logout'])->name('logout');


// Route Dashboard

Route::get('/dosen/dashboard',[ControllerDashboard::class, 'index']);

Route::get('/dosen/profil',[ControllerProfil::class, 'index']);

//Route Mahasiswa
Route::get('/dosen/mahasiswa',[ControllerMahasiswa::class, 'index']);
Route::get('/dosen/mahasiswa/create',[ControllerMahasiswa::class, 'create']);
Route::post('/dosen/mahasiswa/store',[ControllerMahasiswa::class, 'store']);
Route::get('/dosen/mahasiswa/edit/{id_mahasiswa}',[ControllerMahasiswa::class, 'edit']);
Route::put('/dosen/mahasiswa/update/{id_mahasiswa}',[ControllerMahasiswa::class, 'update']);
Route::get('/dosen/mahasiswa/delete/{id_mahasiswa}',[ControllerMahasiswa::class, 'delete']);
Route::post('dosen/mahasiswa/import', [ControllerMahasiswa::class, 'importCsv']);

//Route User
Route::get('/dosen/user',[ControllerUser::class, 'index']);
Route::get('/dosen/user/create',[ControllerUser::class, 'create']);
Route::post('/dosen/user/store',[ControllerUser::class, 'store']);
Route::get('/dosen/user/edit/{id_user}',[ControllerUser::class, 'edit']);
Route::put('/dosen/user/update/{id_user}',[ControllerUser::class, 'update']);
Route::get('/dosen/user/delete/{id_user}',[ControllerUser::class, 'delete']);

//Route Nilai Mahasiswa
Route::get('/dosen/nilai-mahasiswa',[ControllerNilaiMahasiswa::class, 'index']);
Route::get('/dosen/nilai-mahasiswa/create',[ControllerNilaiMahasiswa::class, 'create']);
Route::post('/dosen/nilai-mahasiswa/store',[ControllerNilaiMahasiswa::class, 'store']);
Route::get('/dosen/nilai-mahasiswa/edit/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswa::class, 'edit']);
Route::put('/dosen/nilai-mahasiswa/update/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswa::class, 'update']);
Route::get('/dosen/nilai-mahasiswa/delete/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswa::class, 'delete']);
Route::get('/dosen/nilai-mahasiswa/pertemuan/{idMahasiswa}/{idMatkul}',[ControllerNilaiMahasiswa::class, 'getPertemuanKosong']);



//Route Mata Kuliah
Route::get('/dosen/mata-kuliah',[ControllerMataKuliah::class, 'index']);
Route::get('/dosen/mata-kuliah/create',[ControllerMataKuliah::class, 'create']);
Route::post('/dosen/mata-kuliah/store',[ControllerMataKuliah::class, 'store']);
Route::get('/dosen/mata-kuliah/edit/{id_nilai_mahasiswa}',[ControllerMataKuliah::class, 'edit']);
Route::put('/dosen/mata-kuliah/update/{id_nilai_mahasiswa}',[ControllerMataKuliah::class, 'update']);
Route::get('/dosen/mata-kuliah/delete/{id_nilai_mahasiswa}',[ControllerMataKuliah::class, 'delete']);

//Route Kelompok
Route::get('/dosen/kelompok',[ControllerKelompok::class, 'index']);
Route::get('/dosen/kelompok/create',[ControllerKelompok::class, 'create']);
Route::post('/dosen/kelompok/store',[ControllerKelompok::class, 'store']);
Route::get('/dosen/kelompok/edit/{id_nilai_mahasiswa}',[ControllerKelompok::class, 'edit']);
Route::put('/dosen/kelompok/update/{id_nilai_mahasiswa}',[ControllerKelompok::class, 'update']);
Route::get('/dosen/kelompok/delete/{id_nilai_mahasiswa}',[ControllerKelompok::class, 'delete']);

//Route Nilai Kelompok
Route::get('/dosen/nilai-kelompok',[ControllerNilaiKelompok::class, 'index'])->name('nilai-kelompok.index');
Route::get('/dosen/nilai-kelompok/generate/{id_matkul}',[ControllerNilaiKelompok::class, 'generateNilaiKelompok']);

//Route profil
Route::get('/dosen/profil',[ControllerProfil::class, 'index']);
Route::get('/dosen/profil/edit/{id_user}',[ControllerProfil::class, 'edit']);
Route::put('/dosen/profil/update/{id_user}',[ControllerProfil::class, 'update']);

Route::get('/kaprodi/dashboard',[ControllerKaprodi::class, 'index']);
Route::get('/kaprodi/mata-kuliah',[ControllerKaprodi::class, 'matkul']);
Route::get('/kaprodi/mahasiswa',[ControllerKaprodi::class, 'mahasiswa']);
Route::get('/kaprodi/kelompok',[ControllerKaprodi::class, 'kelompok']);
Route::get('/kaprodi/nilai-mahasiswa',[ControllerKaprodi::class, 'nilaiMahasiswa']);
Route::get('/kaprodi/nilai-kelompok',[ControllerKaprodi::class, 'nilaiKelompok']);
Route::get('/kaprodi/user',[ControllerKaprodi::class, 'user']);
Route::get('/kaprodi/tpk',[ControllerKaprodi::class, 'MahasiswaTerbaik']);


Route::get('/mahasiswa/dashboard', [ControllerUserMahasiswa::class, 'index']);
Route::get('/mahasiswa/nilai-mahasiswa', [ControllerUserMahasiswa::class, 'nilaiMahasiswa']);
Route::get('/mahasiswa/nilai-kelompok', [ControllerUserMahasiswa::class, 'nilaiKelompok']);
Route::get('/mahasiswa/profil', [ControllerUserMahasiswa::class, 'profil']);
Route::get('/mahasiswa/profil/edit/{id_mahasiswa}', [ControllerUserMahasiswa::class, 'editProfil']);
Route::put('/mahasiswa/profil/update/{id_mahasiswa}', [ControllerUserMahasiswa::class, 'updateProfil']);
Route::get('/pembimbing/mata-kuliah', [ControllerPembimbing::class, 'matkul']);
Route::get('/pembimbing/dashboard', [ControllerPembimbing::class, 'index']);
Route::get('/pembimbing/mahasiswa', [ControllerPembimbing::class, 'mahasiswa']);
Route::get('/pembimbing/kelompok', [ControllerPembimbing::class, 'kelompok']);

Route::get('/pembimbing/nilai-mahasiswa', [ControllerPembimbing::class, 'nilaiMahasiswa']);
Route::get('/pembimbing/nilai-mahasiswa/create', [ControllerPembimbing::class, 'createNilaiMahasiswa']);
Route::post('/pembimbing/nilai-mahasiswa/store', [ControllerPembimbing::class, 'storeNilaiMahasiswa']);
Route::get('/pembimbing/nilai-mahasiswa/edit/{id_nilai_mahasiswa}', [ControllerPembimbing::class, 'editNilaiMahasiswa']);
Route::put('/pembimbing/nilai-mahasiswa/update/{id_nilai_mahasiswa}', [ControllerPembimbing::class, 'updateNilaiMahasiswa']);
Route::get('/pembimbing/nilai-mahasiswa/delete/{id_nilai_mahasiswa}', [ControllerPembimbing::class, 'deleteNilaiMahasiswa']);

Route::get('/pembimbing/profil', [ControllerPembimbing::class, 'profil']);
Route::get('/pembimbing/nilai-kelompok', [ControllerPembimbing::class, 'nilaiKelompok']);
Route::get('/pembimbing/profil/edit/{id_user}', [ControllerPembimbing::class, 'editProfil']);
Route::put('/pembimbing/profil/update/{id_user}', [ControllerPembimbing::class, 'updateProfil']);
Route::get('/pembimbing/tpk', [ControllerPembimbing::class, 'mahasiswaTerbaik']);

Route::get('/admin/dashboard', [ControllerDashboardAdmin::class, 'index']);

Route::get('/admin/kelompok', [ControllerKelompokAdmin::class, 'index']);
Route::get('/admin/kelompok/create',[ControllerKelompokAdmin::class, 'create']);
Route::post('/admin/kelompok/store',[ControllerKelompokAdmin::class, 'store']);
Route::get('/admin/kelompok/edit/{id_nilai_mahasiswa}',[ControllerKelompokAdmin::class, 'edit']);
Route::put('/admin/kelompok/update/{id_nilai_mahasiswa}',[ControllerKelompokAdmin::class, 'update']);
Route::get('/admin/kelompok/delete/{id_nilai_mahasiswa}',[ControllerKelompokAdmin::class, 'delete']);

Route::get('/admin/mahasiswa', [ControllerMahasiswaAdmin::class, 'index']);
Route::get('/admin/mahasiswa',[ControllerMahasiswaAdmin::class, 'index']);
Route::get('/admin/mahasiswa/create',[ControllerMahasiswaAdmin::class, 'create']);
Route::post('/admin/mahasiswa/store',[ControllerMahasiswaAdmin::class, 'store']);
Route::get('/admin/mahasiswa/edit/{id_mahasiswa}',[ControllerMahasiswaAdmin::class, 'edit']);
Route::put('/admin/mahasiswa/update/{id_mahasiswa}',[ControllerMahasiswaAdmin::class, 'update']);
Route::get('/admin/mahasiswa/delete/{id_mahasiswa}',[ControllerMahasiswaAdmin::class, 'delete']);
Route::post('admin/mahasiswa/import', [ControllerMahasiswaAdmin::class, 'importCsv']);

Route::get('/admin/mata-kuliah', [ControllerMataKuliahAdmin::class, 'index']);
Route::get('/admin/mata-kuliah/create', [ControllerMataKuliahAdmin::class, 'create']);
Route::post('/admin/mata-kuliah/store', [ControllerMataKuliahAdmin::class, 'store']);
Route::put('/admin/mata-kuliah/update/{id_nilai_mahasiswa}',[ControllerMataKuliahAdmin::class, 'update']);
Route::get('/admin/mata-kuliah/delete/{id_nilai_mahasiswa}',[ControllerMataKuliahAdmin::class, 'delete']);
Route::get('/admin/mata-kuliah/edit/{id_nilai_mahasiswa}',[ControllerMataKuliahAdmin::class, 'edit']);

//Route Nilai Mahasiswa
Route::get('/admin/nilai-mahasiswa',[ControllerNilaiMahasiswaAdmin::class, 'index']);
Route::get('/admin/nilai-mahasiswa/create',[ControllerNilaiMahasiswaAdmin::class, 'create']);
Route::post('/admin/nilai-mahasiswa/store',[ControllerNilaiMahasiswaAdmin::class, 'store']);
Route::get('/admin/nilai-mahasiswa/edit/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswaAdmin::class, 'edit']);
Route::put('/admin/nilai-mahasiswa/update/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswaAdmin::class, 'update']);
Route::get('/admin/nilai-mahasiswa/delete/{id_nilai_mahasiswa}',[ControllerNilaiMahasiswaAdmin::class, 'delete']);

//Route Nilai Kelompok
Route::get('/admin/nilai-kelompok',[ControllerNilaiKelompokAdmin::class, 'index'])->name('nilai-kelompok.index');
Route::get('/admin/nilai-kelompok/generate/{id_matkul}',[ControllerNilaiKelompokAdmin::class, 'generateNilaiKelompok']);

//Route User
Route::get('/admin/user',[ControllerUserAdmin::class, 'index']);
Route::get('/admin/user/create',[ControllerUserAdmin::class, 'create']);
Route::post('/admin/user/store',[ControllerUserAdmin::class, 'store']);
Route::get('/admin/user/edit/{id_user}',[ControllerUserAdmin::class, 'edit']);
Route::put('/admin/user/update/{id_user}',[ControllerUserAdmin::class, 'update']);
Route::get('/admin/user/delete/{id_user}',[ControllerUserAdmin::class, 'delete']);

Route::get('/admin/tpk', [ControllerTpk::class, 'index']);
Route::get('/admin/bobot', [ControllerTpk::class, 'bobot']);

Route::get('/admin/bobot', [ControllerTpk::class, 'bobot']);
Route::get('/admin/bobot/edit', [ControllerTPK::class, 'ahp'])->name('ahp.index');
Route::post('/admin/bobot/hitung', [ControllerTPK::class, 'hitung'])->name('ahp.hitung');
Route::get('admin/tpk', [ControllerTPK::class, 'index'])->name('tpk.index');
Route::get('admin/tpk/hitung', [ControllerTPK::class, 'hitungTPK'])->name('tpk.hitung');

Route::prefix('admin/tenggat-penilaian')->group(function () {
   Route::get('/', [ControllerTenggatPenilaian::class, 'index'])->name('admin.tenggat.index');
   Route::get('/create', [ControllerTenggatPenilaian::class, 'create'])->name('admin.tenggat.create');
   Route::post('/store', [ControllerTenggatPenilaian::class, 'store'])->name('admin.tenggat.store');
   Route::get('/edit/{id}', [ControllerTenggatPenilaian::class, 'edit'])->name('admin.tenggat.edit');
   Route::put('/update/{id}', [ControllerTenggatPenilaian::class, 'update'])->name('admin.tenggat.update');
   Route::get('/delete/{id}', [ControllerTenggatPenilaian::class, 'destroy'])->name('admin.tenggat.delete');

   // route test kirim notif WA
   Route::get('/test-notif', [ControllerTenggatPenilaian::class, 'testNotif'])->name('admin.tenggat.test');
   Route::get('/broadcast', [ControllerTenggatPenilaian::class, 'broadcastDosen'])->name('admin.tenggat.broadcast');
});