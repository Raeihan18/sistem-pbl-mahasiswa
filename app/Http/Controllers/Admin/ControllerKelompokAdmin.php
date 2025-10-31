<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelompok;

class ControllerKelompokAdmin extends Controller
{
    // Menampilkan semua data kelompok
    public function index()
    {
        $kelompok = Kelompok::get();
        return view('admin.kelompok.index', compact('kelompok'));
    }

    // Menampilkan form tambah kelompok
    public function create()
    {
        return view('dosen.kelompok.create');
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
