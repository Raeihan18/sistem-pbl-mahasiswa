<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelompok;
use App\Models\NilaiMahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use App\Models\Profil;
use App\Models\mahasiswaTerbaik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanNilaiMahasiswaExport;


class ControllerPembimbing extends Controller
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
        $mahasiswaTertinggi = NilaiMahasiswa::with('mahasiswa', 'mataKuliah', 'mahasiswa.kelompok')
            ->orderByDesc('total_nilai')
            ->take(5)
            ->get();
        $title = 'Dashboard';
        return view('pembimbing.index', compact(
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

        return view('pembimbing.mata-kuliah', compact('mataKuliah', 'title'));
    }

    public function mahasiswa()
    {
        $mahasiswa = Mahasiswa::get();
        $title = 'Mahasiswa';
        // dd($mahasiswa);

        return view('pembimbing.mahasiswa', compact('mahasiswa', 'title'));
    }

    public function kelompok()
    {
        $kelompok = Kelompok::get();
        $title = 'Kelompok';

        return view('pembimbing.kelompok', compact('kelompok', 'title'));
    }

    public function nilaiMahasiswaOld()
    {
        $id_user = Auth::user()->id_user;

        $nilai_mahasiswa = NilaiMahasiswa::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->leftJoin('matkul', 'nilai_mahasiswa.id_matkul', '=', 'matkul.id_matkul')
            ->leftJoin('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select(
                'nilai_mahasiswa.*',
                'mahasiswa.nama as nama_mahasiswa',
                'matkul.nama_matkul',
                'kelompok.nama_kelompok'
            )
            ->whereIn('nilai_mahasiswa.id_matkul', function ($query) use ($id_user) {
                $query->select('id_matkul')
                    ->from('detail_matkul_dosen')
                    ->where('id_user', $id_user);
            })
            ->get();
        $title = 'Nilai Mahasiswa';

        return view('pembimbing.nilai-mahasiswa.index', compact('nilai_mahasiswa', 'title'));
    }

    public function nilaiMahasiswa(Request $request)
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
        'pembimbing.nilai-mahasiswa.index',
        compact('mahasiswas', 'nilai', 'kelasList', 'kelas', 'title', 'rataMahasiswa', 'rataMatkul', 'search')
    );
}
public function exportExcel()
{
    return Excel::download(new LaporanNilaiMahasiswaExport, 'laporan_nilai_mahasiswa.xlsx');
}

    public function createNilaiMahasiswa()
    {
        $id_user = Auth::user()->id_user; // dosen/pembimbing yang login

        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::whereIn('id_matkul', function ($query) use ($id_user) {
            $query->select('id_matkul')
                ->from('detail_matkul_dosen') // sesuaikan dengan nama tabel sebenarnya
                ->where('id_user', $id_user);
        })->get();
        $title = 'Nilai Mahasiswa';
        return view('pembimbing.nilai-mahasiswa.create', compact('mahasiswa', 'mataKuliah', 'title'));
    }

    public function storeNilaiMahasiswa(Request $request)
    {
        // dd($request->all());

        // Simpan data
        NilaiMahasiswa::create($request->all());
        return redirect('/pembimbing/nilai-mahasiswa')->with('success', 'Nilai mahasiswa berhasil ditambahkan.');
    }

    public function editNilaiMahasiswa($id_nilai_mahasiswa)
    {

        $nilai = NilaiMahasiswa::find($id_nilai_mahasiswa);
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

        return view('pembimbing.nilai-mahasiswa.edit', compact('nilai', 'mahasiswa', 'mataKuliah'));
    }

    public function updateNilaiMahasiswa(Request $request, $id_nilai_mahasiswa)
    {

        $nilai_mahasiswa = NilaiMahasiswa::find($id_nilai_mahasiswa);
        $nilai_mahasiswa->update($request->all());

        return redirect('/pembimbing/nilai-mahasiswa')->with('success', 'Nilai mahasiswa berhasil diperbarui.');
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
        return view('pembimbing.nilai-kelompok', compact('mataKuliah', 'nilaiKelompok', 'title'));
    }

    public function user()
    {
        $users = User::all();
        $title = 'User';
        return view('pembimbing.user', compact('users', 'title'));
    }

    public function profil()
    {
        // Ambil user yang sedang login

        $authUser = auth()->user(); 
        $id_user = $authUser->id_user;
        // dd($authUser);


        // ambil profil berdasarkan id_user
        $profil = Profil::where('id_user', $id_user)->firstOrFail();
        $matkul_pembimbing = $authUser->matkul()->get();
        // dd($matkul_dosen);

        // dd($profil);
        // Ambil data lengkap dari tabel users (atau join ke profil_dosen jika ada)
        $title = 'Profil Pembimbing';
        return view('pembimbing.profil.index', compact('authUser', 'matkul_pembimbing', 'profil', 'title'));
    }

    public function editProfil($id_user)
    {
        $pembimbing = User::findOrFail($id_user);
        $matkul = MataKuliah::all();
        $profil = Profil::where('id_user', $id_user)->firstOrFail();
        $title = 'Profil';

        return view('pembimbing.profil.edit', compact('pembimbing', 'matkul', 'profil', 'title'));
    }

    public function updateProfil(Request $request, $id_profil)
    {
        $profil = Profil::findOrFail($id_profil);
        $user = auth()->user();


        // Update data dasar profil
        $dataUpdate = [
            'NIP' => $request->NIP,
        ];


        // Upload foto baru jika ada
        if ($request->hasFile('potoprofil')) {
            // hapus foto lama jika ada
            if ($profil->potoprofil && Storage::exists('potoprofil/' . $profil->potoprofil)) {
                Storage::delete('potoprofil/' . $profil->potoprofil);
            }


            // simpan foto baru
            $potoprofil = $request->file('potoprofil');
            $potoprofil->storeAs('potoprofil', $potoprofil->hashName());
            $dataUpdate['potoprofil'] = $potoprofil->hashName();
        }


        // Simpan update profil
        $profil->update($dataUpdate);


        // Simpan relasi mata kuliah (checkbox)
        if ($request->has('matkul')) {
            $user->matkul()->sync($request->matkul);
        }


        return redirect('/pembimbing/profil')->with('success', 'Profil berhasil diperbarui.');
    }

        public function mahasiswaTerbaik()
    {
        $mahasiswas = MahasiswaTerbaik::with('mahasiswa')
         ->orderBy('total_nilai', 'desc') // urutkan dari nilai terbesar ke terkecil
        ->get();

        // $mahasiswas = MahasiswaTerbaik::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')->get();

        // dd($mahasiswas);
        $title = 'TPK';
        return view('pembimbing.tpk.index', compact('mahasiswas', 'title'));
    }


}
