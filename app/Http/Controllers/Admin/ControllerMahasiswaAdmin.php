<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelompok;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use App\Http\Controllers\Controller;


class ControllerMahasiswaAdmin extends Controller
{
    public function index(Request $request)
    {

            $search = $request->input('search');

        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')
                ->select('mahasiswa.*', 'kelompok.nama_kelompok')
                ->when($search, function ($query) use ($search) {
                $query->where('mahasiswa.nim', 'LIKE', "%{$search}%")
                  ->orWhere('mahasiswa.nama', 'LIKE', "%{$search}%")
                  ->orWhere('mahasiswa.kelas', 'LIKE', "%{$search}%")
                  ->orWhere('kelompok.nama_kelompok', 'LIKE', "%{$search}%")
                  ->orWhere('mahasiswa.email', 'LIKE', "%{$search}%");
        })
        ->orderBy('mahasiswa.id_mahasiswa', 'DESC')
        ->get();
        // dd($mahasiswa);
        $title = 'Mahasiswa';
        return view('admin.mahasiswa.index', compact('mahasiswa', 'title' ));
    }

    public function create()
    {
        $kelompok = Kelompok::all(); // ambil data semua kelompok
        $title = 'Tambah Mahasiswa';
        return view('admin.mahasiswa.create', compact('kelompok', 'title'));
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

        return redirect('/admin/mahasiswa');
    }

    public function edit($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')->find($id_mahasiswa);
        $kelompok = Kelompok::all(); // ambil semua kelompok
        $title = "Edit Mahasiswa";
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'kelompok', 'title'));
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
        return redirect('/admin/mahasiswa')->with('success', 'Mahasisiwa berhasil diperbarui.');
    }


    public function delete($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $mahasiswa->delete();

        return redirect('/admin/mahasiswa');
    }

    public function importCsv(Request $request)
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
