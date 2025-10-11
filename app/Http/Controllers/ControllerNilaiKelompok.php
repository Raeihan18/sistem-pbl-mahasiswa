<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use Illuminate\Support\Facades\DB;

class ControllerNilaiKelompok extends Controller
{
    public function index(Request $request)
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

    return view('nilai-kelompok.index', compact('mataKuliah', 'nilaiKelompok'));
}

// Generate nilai kelompok dari nilai mahasiswa
    public function generateNilaiKelompok($id_matkul)
    {
        // Ambil semua kelompok yang punya mahasiswa dengan nilai di mata kuliah ini
        $kelompokList = DB::table('mahasiswa')
            ->join('nilai_mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'nilai_mahasiswa.id_mahasiswa')
            ->select('mahasiswa.id_kelompok')
            ->where('nilai_mahasiswa.id_matkul', $id_matkul)
            ->groupBy('mahasiswa.id_kelompok')
            ->get();

        foreach ($kelompokList as $klp) {
            // Ambil semua nilai mahasiswa di kelompok ini
            $nilaiAnggota = DB::table('mahasiswa')
                ->join('nilai_mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'nilai_mahasiswa.id_mahasiswa')
                ->where('mahasiswa.id_kelompok', $klp->id_kelompok)
                ->where('nilai_mahasiswa.id_matkul', $id_matkul)
                ->get();

            if($nilaiAnggota->count() == 0) continue;

            $rataTugas = $nilaiAnggota->avg('nilai_tugas');
            $rataProject = $nilaiAnggota->avg('nilai_project');
            $rataPresentasi = $nilaiAnggota->avg('nilai_presentasi');
            $rataKehadiran = $nilaiAnggota->avg('nilai_kehadiran');
            $totalNilai = ($rataTugas + $rataProject + $rataPresentasi + $rataKehadiran) / 4;

            // Hapus nilai kelompok lama jika sudah ada, agar tidak duplikasi
            DB::table('nilai_kelompok')
                ->where('id_kelompok', $klp->id_kelompok)
                ->where('id_matkul', $id_matkul)
                ->delete();

            // Simpan nilai kelompok baru
            DB::table('nilai_kelompok')->insert([
                'id_kelompok' => $klp->id_kelompok,
                'id_user' => null,
                'id_matkul' => $id_matkul,
                'nilai_tugas' => round($rataTugas),
                'nilai_project' => round($rataProject),
                'nilai_presentasi' => round($rataPresentasi),
                'nilai_kehadiran' => round($rataKehadiran),
                'total_nilai' => round($totalNilai),
            ]);
        }

        return redirect()->route('nilai-kelompok.index', ['id_matkul' => $id_matkul])
                         ->with('success', 'Nilai kelompok berhasil digenerate dari nilai mahasiswa!');
    }
    
}
