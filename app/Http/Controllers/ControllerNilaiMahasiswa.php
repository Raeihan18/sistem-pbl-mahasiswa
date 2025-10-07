<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;
use App\Models\Mahasiswa;

class ControllerNilaiMahasiswa extends Controller
{
    public function index(){
        $nilai_mahasiswa = NilaiMahasiswa::all();

        return view('nilai-mahasiswa.index', compact('nilai_mahasiswa'));   
    }
     public function create(){
        $mahasiswa = Mahasiswa::all();
     return view('nilai-mahasiswa.create', compact('mahasiswa'));   
    }
        public function store(Request $request){
            
            // Simpan data
            NilaiMahasiswa::create($request->all());
    
            return redirect('/dosen/nilai-mahasiswa')->with('success', 'Nilai mahasiswa berhasil ditambahkan.');
    }
     public function edit(){

     return view('nilai-mahasiswa.edit');   
    }
}
