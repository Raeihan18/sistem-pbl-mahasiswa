<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NilaiMahasiswa;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanNilaiMahasiswaExport;



class ControllerNilaiMahasiswaAdmin extends Controller
{
public function index(Request $request)
{
    // Ambil filter kelas (jika ada)
    $kelas = $request->kelas;

    // Daftar kelas
    $kelasList = ["all", "TI-3A", "TI-3B", "TI-3C", "TI-3D", "TI-3E"];

    $search = $request->search;


    // Ambil mahasiswa + kelompok
$mahasiswas = Mahasiswa::leftJoin('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')
    ->select('mahasiswa.*', 'kelompok.nama_kelompok')
    ->when($kelas && $kelas !== 'all', function ($q) use ($kelas) {
        $q->where('mahasiswa.kelas', $kelas);
    })
    ->when($search, function ($q) use ($search) {
        $q->where(function($q2) use ($search) {
            $q2->where('mahasiswa.nama', 'LIKE', "%{$search}%")
               ->orWhere('kelompok.nama_kelompok', 'LIKE', "%{$search}%");
        });
    })
    ->orderBy('mahasiswa.nama')
    ->get();

    // Ambil nilai mahasiswa → group: mahasiswa → matkul → pertemuan
    $nilai = NilaiMahasiswa::leftJoin('matkul', 'nilai_mahasiswa.id_matkul', '=', 'matkul.id_matkul')
        ->select('nilai_mahasiswa.*', 'matkul.nama_matkul')
        ->orderBy('nilai_mahasiswa.id_mahasiswa')
        ->orderBy('nilai_mahasiswa.id_matkul')
        ->orderBy('nilai_mahasiswa.pertemuan')
        ->get()
        ->groupBy('id_mahasiswa')
        ->map(function ($matkulGroup) {
            return $matkulGroup->groupBy('id_matkul');
        });

    // Hitung rata-rata global per mahasiswa
    $rataMahasiswa = NilaiMahasiswa::selectRaw('
            id_mahasiswa,
            AVG((nilai_tugas + nilai_project + nilai_presentasi + nilai_kehadiran) / 4) as rata_rata
        ')
        ->groupBy('id_mahasiswa')
        ->pluck('rata_rata', 'id_mahasiswa');

    // Hitung rata-rata per mahasiswa per matkul
    $rataMatkul = NilaiMahasiswa::selectRaw('
            id_mahasiswa,
            id_matkul,
            AVG((nilai_tugas + nilai_project + nilai_presentasi + nilai_kehadiran) / 4) as rata_rata
        ')
        ->groupBy('id_mahasiswa', 'id_matkul')
        ->get()
        ->groupBy('id_mahasiswa')
        ->map(function ($group) {
            return $group->pluck('rata_rata', 'id_matkul');
        });

    $title = "Nilai Mahasiswa";

    return view(
        'admin.nilai-mahasiswa.index',
        compact('mahasiswas', 'nilai', 'kelasList', 'kelas', 'title', 'rataMahasiswa', 'rataMatkul', 'search')
    );
}



     public function create(){
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();
        $title = "Tambah Nilai Mahasiswa";
      return view('admin.nilai-mahasiswa.create', compact('mahasiswa', 'mataKuliah', 'title'));
   }
   public function store(Request $request)
   {
      // 🔹 1. Validasi input
      $validated = $request->validate([
         'id_mahasiswa'      => 'required|exists:mahasiswa,id_mahasiswa',
         'id_matkul'         => 'required|exists:matkul,id_matkul',
         'pertemuan'         => 'required|integer|min:1|max:16',
         'nilai_tugas'       => 'required|numeric|min:0|max:100',
         'nilai_project'     => 'required|numeric|min:0|max:100',
         'nilai_presentasi'  => 'required|numeric|min:0|max:100',
         'nilai_kehadiran'   => 'required|numeric|min:0|max:100',
      ], [
         'pertemuan.unique'  => 'Pertemuan ini sudah diisi untuk mahasiswa dan matkul tersebut.',
         'pertemuan.required' => 'Pertemuan wajib dipilih.',
      ]);


      // 🔹 2. Cegah duplikasi pertemuan
      $exists = NilaiMahasiswa::where('id_mahasiswa', $validated['id_mahasiswa'])
         ->where('id_matkul', $validated['id_matkul'])
         ->where('pertemuan', $validated['pertemuan'])
         ->exists();


      if ($exists) {
         return back()
            ->withErrors(['pertemuan' => 'Pertemuan ke-' . $validated['pertemuan'] . ' untuk mahasiswa ini sudah diinput.'])
            ->withInput();
      }


      // 🔹 3. Simpan data
      NilaiMahasiswa::create($validated);


      // 🔹 4. Redirect sukses
      return redirect('/admin/nilai-mahasiswa')
         ->with('success', 'Nilai mahasiswa pertemuan ke-' . $validated['pertemuan'] . ' berhasil ditambahkan.');
   }

public function getPertemuanKosong($id_mahasiswa, $id_matkul)
{
    // Ambil semua pertemuan (1-16)
    $semuaPertemuan = range(1, 16);


    // Ambil pertemuan yang sudah digunakan
    $terpakai = NilaiMahasiswa::where('id_mahasiswa', $id_mahasiswa)
        ->where('id_matkul', $id_matkul)
        ->pluck('pertemuan')
        ->toArray();


    // Filter hanya yang belum terpakai
    $tersedia = array_values(array_diff($semuaPertemuan, $terpakai));


    return response()->json($tersedia);
}



public function exportExcel()
{
    return Excel::download(new LaporanNilaiMahasiswaExport, 'laporan_nilai_mahasiswa.xlsx');
}



   public function edit($id_nilai_mahasiswa)
   {


      $nilai = NilaiMahasiswa::find($id_nilai_mahasiswa);
      $mahasiswa = Mahasiswa::all();
      $mataKuliah = MataKuliah::all();
      $title ="Edit Nilai Mahasiswa";

      return view('admin.nilai-mahasiswa.edit', compact('nilai', 'mahasiswa', 'mataKuliah', 'title'));
   }
   public function update(Request $request, $id_nilai_mahasiswa)
   {


      $nilai_mahasiswa = NilaiMahasiswa::find($id_nilai_mahasiswa);
      $nilai_mahasiswa->update($request->all());


      return redirect('/admin/nilai-mahasiswa')->with('success', 'Nilai mahasiswa berhasil diperbarui.');
   }


   public function delete($id_nilai_mahasiswa)
   {


      $nilai_mahasiswa = NilaiMahasiswa::find($id_nilai_mahasiswa);
      $nilai_mahasiswa->delete();


      return redirect('/admin/nilai-mahasiswa');
   }
}
