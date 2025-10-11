<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelompok;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;

class ControllerMahasiswa extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')->get();

     return view('mahasiswa.index', compact('mahasiswa'));
    }
    
    public function create(){
          $kelompok = Kelompok::all(); // ambil data semua kelompok
     return view('mahasiswa.create',compact('kelompok'));   
    }

    public function store(Request $request){
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'id_kelompok' => $request->id_kelompok,
            'email' => $request->email,
            'password' => bcrypt ($request->password),
        ]);

     return redirect('/dosen/mahasiswa');
    }

    public function edit($id_mahasiswa){
         $mahasiswa = Mahasiswa::join('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')->find($id_mahasiswa);
        $kelompok = Kelompok::all(); // ambil semua kelompok
     return view('mahasiswa.edit', compact('mahasiswa','kelompok'));   
    }

     public function update(Request $request, $id_mahasiswa){
            $mahasiswa = Mahasiswa::find($id_mahasiswa);
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->kelas = $request->kelas;
            $mahasiswa->id_kelompok = $request->id_kelompok;
            $mahasiswa->email = $request->email;
            if($request->password){
                $mahasiswa->password = bcrypt($request->password);
            }
            $mahasiswa->save();
     return redirect('/dosen/mahasiswa')->with('success', 'Mahasisiwa berhasil diperbarui.');
    }


    public function delete($id_mahasiswa){
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $mahasiswa->delete();

     return redirect('/dosen/mahasiswa');
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            return redirect()->back()->with('error', 'Gagal membuka file CSV.');
        }

        $header = fgetcsv($handle, 1000, ','); // baca header
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $data = array_combine($header, $row);

            // Simpan ke database
            Mahasiswa::updateOrCreate(
                ['nim' => $data['nim']], // jika NIM sudah ada, update
                [
                    'nama' => $data['nama'],
                    'kelas' => $data['kelas'],
                    'id_kelompok' => $data['id_kelompok'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                ]
            );
        }

        fclose($handle);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimpor dari CSV.');
    }
}

