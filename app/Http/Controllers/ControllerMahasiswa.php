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

     public function edit(){

     return view('mahasiswa.edit');   
    }

    public function delete($id_mahasiswa){
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $mahasiswa->delete();

     return redirect('/dosen/mahasiswa');
    }
}

