<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaTerbaik;
use Illuminate\Support\Facades\DB;
use App\Models\Bobot;
use Illuminate\Http\Request;

class ControllerTpkDosen extends Controller
{
    public function index()
    {
        $mahasiswas = MahasiswaTerbaik::with('mahasiswa')
         ->orderBy('total_nilai', 'desc') // urutkan dari nilai terbesar ke terkecil
        ->get();

        // $mahasiswas = MahasiswaTerbaik::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')->get();

        // dd($mahasiswas);
        $title = 'TPK';
        return view('dosen.tpk.index', compact('mahasiswas', 'title'));
    }

    public function bobot()
    {
        $bobots = Bobot::all();
        $title = 'Bobot';
        return view('dosen.tpk.bobot.index', compact('bobots', 'title'));
    }

    public function createbobot(){

        $title = "Tambah Atribut";
        return view('dosen.tpk.bobot.create-atribut', compact('title'));   
    }

     public function storebobot(Request $request){
        // Simpan data
        Bobot::create($request->all());
        
        return redirect('/dosen/bobot')->with('success', 'Atribut TPK berhasil ditambahkan.');
    }

    public function editbobot($id_bobot){

        $bobot = Bobot::find($id_bobot);
        $title = "Edit Mata Kuliah";
     return view('dosen.tpk.bobot.edit-atribut', compact('bobot', 'title'));   
    }

    public function updatebobot(Request $request, $id_bobot){
    
        $bobot = Bobot::find($id_bobot);
        $bobot->update($request->all());
    
     return redirect('/dsoen/bobot')->with('success', 'Atribut berhasil diperbarui.');
    }

    public function deletebobot($id_bobot){

        $bobot = Bobot::find($id_bobot);
        
        $bobot->delete();

        return redirect('/dosen/bobot')->with('success', 'Atribut berhasil Dihapus.');
    }



    public function ahp()
    {
        // Ambil daftar kriteria dari tb_bobot
        $kriteria = DB::table('bobot')->pluck('kriteria')->toArray();
        $title = "Update Bobot";
        return view('dosen.tpk.bobot.edit', compact('kriteria', 'title'));
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

        return redirect()->route('dosen.tpk.index')->with('success', 'Perhitungan bobot berhasil!');
    }

    public function hitungTPK()
    {
        // Ambil bobot AHP dari tb_bobot
        $bobot = DB::table('bobot')->pluck('bobot', 'kriteria')->toArray();

        // Ambil rata-rata nilai per mahasiswa
        $data = DB::table('nilai_mahasiswa')
            ->select(
                'id_mahasiswa',
                DB::raw('AVG(CASE WHEN id_matkul = 1 THEN total_nilai END) AS iot'),
                DB::raw('AVG(CASE WHEN id_matkul = 2 THEN total_nilai END) AS keamanan_data'),
                DB::raw('AVG(CASE WHEN id_matkul = 3 THEN total_nilai END) AS web_lanjut'),
                DB::raw('AVG(CASE WHEN id_matkul = 4 THEN total_nilai END) AS it_project'),
                DB::raw('((AVG(nilai_kehadiran) + AVG(nilai_presentasi)) / 2) AS partisipasi'),
                DB::raw('AVG(nilai_project) AS hasil_proyek')
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
                'iot' => round($mhs->iot, 2),
                'keamanan_data' => round($mhs->keamanan_data, 2),
                'web_lanjut' => round($mhs->web_lanjut, 2),
                'it_project' => round($mhs->it_project, 2),
                'partisipasi' => round($mhs->partisipasi, precision: 2),
                'hasil_proyek' => round($mhs->hasil_proyek, 2),
                'total_nilai' => round($total, 4),
            ];
        }

        // Simpan hasil
        DB::table('mahasiswa-terbaik')->truncate();
        DB::table('mahasiswa-terbaik')->insert($hasil);

        return redirect()->route('dosen.tpk.index')->with('success', 'Perhitungan TPK berhasil dilakukan!');
    }
}