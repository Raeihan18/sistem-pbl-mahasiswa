<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class ControllerMahasiswa extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();

     return view('mahasiswa.index', compact('mahasiswa'));
    }
    
    public function create(){

     return view('mahasiswa.create');   
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
         $mahasiswa = Mahasiswa::find($id_mahasiswa);

     return view('mahasiswa.edit', compact('mahasiswa'));   
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
}

