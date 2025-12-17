<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiMahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nilai_mahasiswa')->truncate();

        // DATA RATA-RATA (Alternatif)
        $data = [
            1 => [78.15, 56.81, 74.70, 79.31],
            2 => [81.55, 76.22, 80.40, 79.27],
            3 => [84.65, 84.40, 71.48, 81.00],
            4 => [78.40, 75.99, 80.66, 78.58],
            5 => [79.65, 80.71, 79.53, 78.95],
            6 => [76.65, 69.80, 75.82, 78.58],
            7 => [81.15, 81.51, 77.21, 30.98],
            8 => [76.65, 76.62, 74.33, 75.52],
            9 => [78.40, 78.66, 73.59, 79.42],
            10 => [80.40, 82.02, 80.30, 81.85],
        ];

        foreach ($data as $idMahasiswa => $nilaiMatkul) {

            foreach ($nilaiMatkul as $index => $totalNilai) {

                $idMatkul = $index + 1;

                for ($pertemuan = 1; $pertemuan <= 16; $pertemuan++) {

                    // nilai partisipasi = rata-rata presensi + kehadiran
                    $presentasi = rand(70, 90);
                    $kehadiran  = rand(70, 90);
                    $partisipasi = ($presentasi + $kehadiran) / 2;

                    DB::table('nilai_mahasiswa')->insert([
                        'id_mahasiswa'      => $idMahasiswa,
                        'id_matkul'         => $idMatkul,
                        'id_user'           => null,
                        'nilai_tugas'       => round($totalNilai - 2, 2),
                        'nilai_project'     => round($totalNilai + 1, 2),
                        'nilai_presentasi'  => round($presentasi, 2),
                        'nilai_kehadiran'   => round($kehadiran, 2),
                        'total_nilai'       => $totalNilai,
                        'Pertemuan'         => $pertemuan,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                }
            }
        }
    }
}
