<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelompok;
use App\Models\MataKuliah;
use App\Models\Profil;
use App\Models\NilaiMahasiswa;
use Illuminate\Support\Facades\DB;

class ControllerDashboard extends Controller
{
    public function index()
{
    // Statistik dasar
    $totalMahasiswa = Mahasiswa::count();
    $totalMataKuliah = MataKuliah::count();
    $totalKelompok = Kelompok::count();
    $nilaiRata = NilaiMahasiswa::avg('total_nilai');

    // Rata-rata nilai per mata kuliah
    $rataPerMatkul = NilaiMahasiswa::select('id_matkul', DB::raw('AVG(total_nilai) as rata_nilai'))
        ->groupBy('id_matkul')
        ->with('mataKuliah')
        ->get();

    $namaMatkul = [];
    $nilaiRataMatkul = [];
    foreach ($rataPerMatkul as $item) {
        $namaMatkul[] = $item->mataKuliah->nama_matkul;
        $nilaiRataMatkul[] = round($item->rata_nilai, 2);
    }

    // Ambil 5 mahasiswa dengan nilai tertinggi
    $mahasiswaTertinggi = NilaiMahasiswa::with('mahasiswa','mataKuliah','mahasiswa.kelompok')
        ->orderByDesc('total_nilai')
        ->take(5)
        ->get();

    $authUser = auth()->user();
    $id_user = $authUser->id_user;
    $profil = Profil::where('id_user', $id_user)->firstOrFail();

    return view('dosen.dashboard.index', compact(
        'totalMahasiswa',
        'totalMataKuliah',
        'totalKelompok',
        'nilaiRata',
        'namaMatkul',
        'nilaiRataMatkul',
        'mahasiswaTertinggi',
        // 'profil'
    ));
}

}
