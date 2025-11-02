<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelompok;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;

class ControllerMahasiswa extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')->get();
        // dd($mahasiswa);
        $title = 'Mahasiswa';
        return view('dosen.mahasiswa.index', compact('mahasiswa', 'title'));
    }

    public function create()
    {
        $title = 'Mahasiswa';
        $kelompok = Kelompok::all(); // ambil data semua kelompok
        return view('dosen.mahasiswa.create', compact('kelompok', 'title'));
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'email' => 'required|email|max:100',
            'password' => 'required|min:6',
        ], [
            // 🔹 Pesan error kustom (opsional)
            'nim.unique' => 'NIM sudah terdaftar.',
            'nim.required' => 'NIM wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);



       Mahasiswa::create([
            'nim' => $validated['nim'],
            'nama' => $validated['nama'],
            'kelas' => $validated['kelas'],
            'id_kelompok' => $validated['id_kelompok'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect('/dosen/mahasiswa');
    }

    public function edit($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')->find($id_mahasiswa);
        $kelompok = Kelompok::all(); // ambil semua kelompok
        return view('dosen.mahasiswa.edit', compact('mahasiswa', 'kelompok'));
    }

    public function update(Request $request, $id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->kelas = $request->kelas;
        $mahasiswa->id_kelompok = $request->id_kelompok;
        $mahasiswa->email = $request->email;
        if ($request->password) {
            $mahasiswa->password = bcrypt($request->password);
        }
        $mahasiswa->save();
        return redirect('/dosen/mahasiswa')->with('success', 'Mahasisiwa berhasil diperbarui.');
    }


    public function delete($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $mahasiswa->delete();

        return redirect('/dosen/mahasiswa');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        try {
            Excel::import(new MahasiswaImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data mahasiswa berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}
