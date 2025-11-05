<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelompok;
use App\Models\NilaiMahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ControllerKaprodi extends Controller
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
    $title = 'Dashboard';
    return view('kaprodi.index', compact(
        'totalMahasiswa',
        'totalMataKuliah',
        'totalKelompok',
        'nilaiRata',
        'namaMatkul',
        'nilaiRataMatkul',
        'mahasiswaTertinggi',
        'title'
    ));
}

    public function matkul()
    {
        $mataKuliah = MataKuliah::get();
        $title = 'Mata Kuliah';
       
        return view('kaprodi.mata-kuliah',compact('mataKuliah','title')); 
    }

    public function mahasiswa()
    {
        $mahasiswa = Mahasiswa::get();
        $title = 'Mahasiswa';
       
        return view('kaprodi.mahasiswa',compact('mahasiswa','title')); 
    }

    public function kelompok()
    {
        $kelompok = Kelompok::get();
        $title = 'Kelompok';
       
        return view('kaprodi.kelompok',compact('kelompok','title')); 
    }

    public function nilaiMahasiswa()
    {
        $nilai_mahasiswa = NilaiMahasiswa::get();
        $title = 'Nilai Mahasiswa';
       
        return view('kaprodi.nilai-mahasiswa',compact('nilai_mahasiswa','title')); 
    }

    public function nilaiKelompok(Request $request)
    {
    $mataKuliah = DB::table('matkul')->get();
    $nilaiKelompok = [];

    if ($request->has('id_matkul')) {
        $nilaiKelompok = DB::table('nilai_kelompok')
            ->join('kelompok', 'nilai_kelompok.id_kelompok', '=', 'kelompok.id_kelompok')
            ->where('nilai_kelompok.id_matkul', $request->id_matkul)
            ->select('nilai_kelompok.*', 'kelompok.nama_kelompok')
            ->get();
    }
    $title = 'Nilai Kelompok';

    return view('kaprodi.nilai-kelompok', compact('mataKuliah', 'nilaiKelompok','title'));
    }


    public function user()
    {
        $users = User::all();
        $title = 'User';
        return view('kaprodi.user', compact('users','title'));
    }




}
