<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\NilaiMahasiswa;
use App\Models\NilaiKelompok;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ControllerUserMahasiswa extends Controller
{

    public function index()
    {
        $mahasiswaId = session('mahasiswa_id');

        if (!$mahasiswaId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data mahasiswa dan kelompoknya
        $mahasiswa = Mahasiswa::with('kelompok')->find($mahasiswaId);

        // Statistik nilai individu
        $totalMataKuliah = NilaiMahasiswa::where('id_mahasiswa', $mahasiswaId)
            ->distinct('id_matkul')
            ->count('id_matkul');

        $nilaiRata = round(NilaiMahasiswa::where('id_mahasiswa', $mahasiswaId)->avg('total_nilai'), 2);

        // Nilai kelompok mahasiswa
        $nilaiKelompok = NilaiKelompok::where('id_kelompok', $mahasiswa->id_kelompok)
            ->avg('total_nilai');
        $nilaiKelompok = round($nilaiKelompok, 2);

        // Rata-rata nilai per matkul (untuk grafik)
        $rataPerMatkul = NilaiMahasiswa::select('id_matkul', DB::raw('AVG(total_nilai) as rata_nilai'))
            ->where('id_mahasiswa', $mahasiswaId)
            ->groupBy('id_matkul')
            ->with('mataKuliah')
            ->get();

        $namaMatkul = [];
        $nilaiRataMatkul = [];
        foreach ($rataPerMatkul as $item) {
            $namaMatkul[] = $item->mataKuliah->nama_matkul;
            $nilaiRataMatkul[] = round($item->rata_nilai, 2);
        }

        return view('user-mahasiswa.index', compact(
            'mahasiswa',
            'totalMataKuliah',
            'nilaiRata',
            'nilaiKelompok',
            'namaMatkul',
            'nilaiRataMatkul'
        ));
    }

    public function nilaiMahasiswa()
    {
        // Ambil id mahasiswa dari session (pastikan diset saat login)
        $mahasiswaId = session('mahasiswa_id');

        // Jika belum login, arahkan ke halaman login
        if (!$mahasiswaId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data nilai mahasiswa beserta relasi
        $nilai_mahasiswa = NilaiMahasiswa::query()
            ->leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->leftJoin('matkul', 'nilai_mahasiswa.id_matkul', '=', 'matkul.id_matkul')
            ->leftJoin('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select(
                'nilai_mahasiswa.id_nilai_mahasiswa',
                'mahasiswa.nama as nama_mahasiswa',
                'matkul.nama_matkul',
                'kelompok.nama_kelompok',
                'nilai_mahasiswa.nilai_tugas',
                'nilai_mahasiswa.nilai_project',
                'nilai_mahasiswa.nilai_presentasi',
                'nilai_mahasiswa.nilai_kehadiran',
                'nilai_mahasiswa.total_nilai'
            )
            ->where('nilai_mahasiswa.id_mahasiswa', $mahasiswaId)
            ->orderBy('matkul.nama_matkul', 'asc')
            ->get();

        // kirim ke view
        return view('user-mahasiswa.nilai-mahasiswa', compact('nilai_mahasiswa'));
    }

    public function nilaiKelompok(Request $request)
    {
        // Ambil id mahasiswa yang sedang login
        $mahasiswaId = session('mahasiswa_id');

        // Ambil data mahasiswa untuk tahu dia di kelompok mana
        $mahasiswa = Mahasiswa::find($mahasiswaId);

        if (!$mahasiswa) {
            return redirect('/login')->withErrors(['email' => 'Silakan login terlebih dahulu']);
        }

        // Ambil id_kelompok dari mahasiswa login
        $idKelompok = $mahasiswa->id_kelompok;

        // Ambil semua mata kuliah (untuk dropdown/filter)
        $mataKuliah = DB::table('matkul')->get();

        // Query nilai kelompok, tapi khusus kelompok mahasiswa login
        $query = DB::table('nilai_kelompok')
            ->join('kelompok', 'nilai_kelompok.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select('nilai_kelompok.*', 'kelompok.nama_kelompok')
            ->where('nilai_kelompok.id_kelompok', $idKelompok);

        // Jika user pilih mata kuliah tertentu (filter)
        if ($request->filled('id_matkul')) {
            $query->where('nilai_kelompok.id_matkul', $request->id_matkul);
        }

        $nilaiKelompok = $query->get();

        return view('user-mahasiswa.nilai-kelompok', compact('mataKuliah', 'nilaiKelompok'));
    }
    public function profil()
    {
        // Ambil ID mahasiswa dari session (diset saat login)
        $mahasiswaId = session('mahasiswa_id');

        if (!$mahasiswaId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data mahasiswa berdasarkan ID
        $authUser = Mahasiswa::findOrFail($mahasiswaId);
        // dd($authUser);
        // Karena mahasiswa tidak punya tabel profil sendiri (seperti dosen),
        // maka kita anggap data profilnya langsung dari tabel mahasiswa.
        // Kalau nanti kamu tambahkan kolom tambahan (foto, bio, dll), bisa disesuaikan lagi.

        return view('user-mahasiswa.profil', compact('authUser'));
    }

    public function editProfil($id_mahasiswa)
    {
        // Ambil data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);

        return view('user-mahasiswa.edit-profil', compact('mahasiswa'));
    }

    public function updateProfil(Request $request, $id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'kelas' => 'required|string|max:10',
            'potoprofil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('potoprofil')) {
            if ($mahasiswa->potoprofil && Storage::exists('potoprofil/' . $mahasiswa->potoprofil)) {
                Storage::delete('potoprofil/' . $mahasiswa->potoprofil);
            }

            $foto = $request->file('potoprofil');
            $foto->storeAs('potoprofil', $foto->hashName());
            $validated['potoprofil'] = $foto->hashName();
        }

        // Update data mahasiswa
        $mahasiswa->update($validated);

        return redirect('/mahasiswa/profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
