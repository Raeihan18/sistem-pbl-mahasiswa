<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaTerbaik;
use Illuminate\Support\Facades\DB;
use App\Models\Bobot;
use Illuminate\Http\Request;

class ControllerTpk extends Controller
{
        public function index(){
        $mahasiswas = MahasiswaTerbaik::all();

        // $mahasiswas = MahasiswaTerbaik::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')->get();


        // dd($mahasiswas);
        $title = 'TPK';
        return view('admin.tpk.index',compact('mahasiswas','title'));
    }

        public function bobot(){
        $bobots = Bobot::all();
        $title = 'Bobot';
        return view('admin.tpk.bobot.index',compact('bobots','title'));
    }


    public function ahp()
    {
        // Ambil daftar kriteria dari tb_bobot
        $kriteria = DB::table('bobot')->pluck('kriteria')->toArray();
        $title = "Update Bobot";
        return view('admin.tpk.bobot.edit', compact('kriteria', 'title'));
    }

    public function hitung(Request $request)
    {
        $kriteria = DB::table('bobot')->pluck('kriteria')->toArray();
        $n = count($kriteria);

        // 1️⃣ Ambil input pairwise dari form
        $pairwise = [];
        foreach ($kriteria as $i => $row) {
            foreach ($kriteria as $j => $col) {
                $pairwise[$i][$j] = floatval($request->input("nilai_{$i}_{$j}", 1));
            }
        }

        // 2️⃣ Normalisasi matriks per kolom
        $colSum = [];
        for ($j = 0; $j < $n; $j++) {
            $colSum[$j] = array_sum(array_column($pairwise, $j));
        }

        $normalized = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalized[$i][$j] = $pairwise[$i][$j] / $colSum[$j];
            }
        }

        // 3️⃣ Hitung bobot rata-rata tiap baris
        $bobot = [];
        for ($i = 0; $i < $n; $i++) {
            $bobot[$i] = array_sum($normalized[$i]) / $n;
        }

        // 4️⃣ Simpan hasil ke DB
        foreach ($kriteria as $i => $nama) {
            DB::table('bobot')->where('kriteria', $nama)->update([
                'bobot' => round($bobot[$i], 4)
            ]);
        }

        return redirect()->route('ahp.index')->with('success', 'Perhitungan bobot berhasil!');
    }

       public function hitungTPK()
    {
        // Ambil bobot AHP dari tb_bobot
        $bobot = DB::table('bobot')->pluck('bobot', 'kriteria')->toArray();

        // Ambil rata-rata nilai per mahasiswa
        $data = DB::table('nilai_mahasiswa')
            ->select(
                'id_mahasiswa',
                DB::raw('AVG(CASE WHEN id_matkul = 1 THEN total_nilai END) AS IOT'),
                DB::raw('AVG(CASE WHEN id_matkul = 2 THEN total_nilai END) AS Keamanan_Data'),
                DB::raw('AVG(CASE WHEN id_matkul = 3 THEN total_nilai END) AS Web_Lanjut'),
                DB::raw('AVG(CASE WHEN id_matkul = 4 THEN total_nilai END) AS IT_Project'),
                DB::raw('((AVG(nilai_kehadiran) + AVG(nilai_presentasi)) / 2) AS Partisipasi'),
                DB::raw('AVG(nilai_project) AS Hasil_Proyek')
            )
            ->groupBy('id_mahasiswa')
            ->get();

        // Normalisasi dan hitung SAW
        $maxValues = [];
        foreach (array_keys($bobot) as $key) {
            $maxValues[$key] = $data->max($key);
        }

        $hasil = [];
        foreach ($data as $mhs) {
            $total = 0;
            foreach ($bobot as $kriteria => $nilaiBobot) {
                $value = $mhs->$kriteria ?? 0;
                $normal = $maxValues[$kriteria] ? ($value / $maxValues[$kriteria]) : 0;
                $total += $normal * $nilaiBobot;
            }

            $hasil[] = [
                'id_mahasiswa' => $mhs->id_mahasiswa,
                'IOT' => round($mhs->IOT, 2),
                'Keamanan_Data' => round($mhs->Keamanan_Data, 2),
                'Web_Lanjut' => round($mhs->Web_Lanjut, 2),
                'IT_Project' => round($mhs->IT_Project, 2),
                'Partisipasi' => round($mhs->Partisipasi, 2),
                'Hasil_Proyek' => round($mhs->Hasil_Proyek, 2),
                'total_nilai' => round($total, 4),
            ];
        }

        // Simpan hasil
        DB::table('mahasiswa-terbaik')->truncate();
        DB::table('mahasiswa-terbaik')->insert($hasil);

        return redirect()->route('tpk.index')->with('success', 'Perhitungan TPK berhasil dilakukan!');
    }
}