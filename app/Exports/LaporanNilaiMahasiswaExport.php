<?php

namespace App\Exports;

use App\Models\NilaiMahasiswa;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanNilaiMahasiswaExport implements 
    FromArray, 
    WithHeadings, 
    ShouldAutoSize,
    WithStyles
{
    protected $headings;
    protected $data;

    public function __construct()
    {
        // Ambil matkul untuk kolom dinamis
        $matkuls = MataKuliah::orderBy('nama_matkul')->get();

        // Header utama
        $this->headings = array_merge(
            ['Nama Mahasiswa', 'Kelompok'],
            $matkuls->pluck('nama_matkul')->toArray()
        );

        $colCount = count($this->headings);
        $this->data = [];

        /**
         * ============================
         *   SECTION 1 : NILAI MAHASISWA
         * ============================
         */

        // Tambah judul section (wajib tidak pakai "=")
        $titleRow = array_fill(0, $colCount, '');
        $titleRow[0] = 'NILAI MAHASISWA';
        $this->data[] = $titleRow;

        // Tambahkan header tabel mahasiswa
        $this->data[] = $this->headings;

        // Ambil list mahasiswa
        $mahasiswaList = NilaiMahasiswa::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->leftJoin('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select('mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'kelompok.nama_kelompok')
            ->groupBy('mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'kelompok.nama_kelompok')
            ->orderBy('mahasiswa.nama')
            ->get();

        // Isi nilai mahasiswa pivot
        foreach ($mahasiswaList as $mhs) {
            $row = [$mhs->nama, $mhs->nama_kelompok];

            foreach ($matkuls as $matkul) {
                $nilai = NilaiMahasiswa::where('id_mahasiswa', $mhs->id_mahasiswa)
                    ->where('id_matkul', $matkul->id_matkul)
                    ->selectRaw('AVG((nilai_tugas + nilai_project + nilai_presentasi + nilai_kehadiran) / 4) as nilai_akhir')
                    ->value('nilai_akhir');

                $row[] = $nilai ? round($nilai, 2) : '-';
            }

            // pastikan jumlah kolom konsisten
            $this->data[] = array_pad($row, $colCount, '');
        }

        // Tambah jarak antar section
        $this->data[] = array_fill(0, $colCount, '');
        $this->data[] = array_fill(0, $colCount, '');

        /**
         * ============================
         *   SECTION 2 : NILAI KELOMPOK
         * ============================
         */

        // Judul section kelompok
        $titleRow2 = array_fill(0, $colCount, '');
        $titleRow2[0] = 'NILAI KELOMPOK';
        $this->data[] = $titleRow2;

        // Header kelompok (sejajar dengan kolom mahasiswa)
        $kelompokHeader = array_fill(0, $colCount, '');
        $kelompokHeader[0] = 'Kelompok';

        foreach ($matkuls->values() as $i => $mk) {
            $kelompokHeader[2 + $i - 1] = $mk->nama_matkul; // taruh mulai kolom ke-2
        }

        $this->data[] = $kelompokHeader;

        // Data kelompok
        $kelompokList = DB::table('kelompok')->orderBy('nama_kelompok')->get();

        foreach ($kelompokList as $klp) {
            $row = array_fill(0, $colCount, '');
            $row[0] = $klp->nama_kelompok;

            foreach ($matkuls->values() as $i => $mk) {
                $nilai = DB::table('nilai_kelompok')
                    ->where('id_kelompok', $klp->id_kelompok)
                    ->where('id_matkul', $mk->id_matkul)
                    ->value('total_nilai');

                $row[2 + $i - 1] = $nilai ? round($nilai) : '-';
            }

            $this->data[] = $row;
        }
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],   // heading utama bold
        ];
    }
}
