<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;

class controllerKelompok extends Controller
{
    // Menampilkan semua data kelompok
    public function index()
    {
        $kelompok = Kelompok::get();
        $title = 'Kelompok';
        return view('dosen.kelompok.index', compact('kelompok', 'title'));
    }

    // Menampilkan form tambah kelompok
    public function create()
    {
        $title = 'Kelompok';
        return view('dosen.kelompok.create', compact('title'));
    }

    // Menyimpan data kelompok baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required|string|max:100',
        ]);

        Kelompok::create([
            'id_kelompok' => $request->id_kelompok,
            'nama_kelompok' => $request->nama_kelompok,
        ]);

        return redirect('dosen/kelompok')->with('success', 'Kelompok berhasil ditambahkan!');
    }

    // Menampilkan form edit kelompok
    public function edit($id_kelompok)
    {
        $kelompok = Kelompok::findOrFail($id_kelompok);
        return view('dosen.kelompok.edit', compact('kelompok'));
    }

    // Update data kelompok
    public function update(Request $request, $id_kelompok)
    {
        $request->validate([
            'nama_kelompok' => 'required|string|max:100',
        ]);

        $kelompok = Kelompok::findOrFail($id_kelompok);
        $kelompok->update([
            'nama_kelompok' => $request->nama_kelompok,
        ]);

        return redirect('dosen/kelompok')->with('success', 'Kelompok berhasil diperbarui!');
    }

    // Hapus data kelompok
    public function delete($id_kelompok)
    {
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $kelompok->delete();

        return redirect('dosen/kelompok')->with('success', 'Kelompok berhasil dihapus!');
    }
}
