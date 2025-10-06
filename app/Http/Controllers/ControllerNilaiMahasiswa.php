<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;

class ControllerNilaiMahasiswa extends Controller
{
    public function index(){
        $nilai_mahasiswa = NilaiMahasiswa::all();

        return view('nilai-mahasiswa.index', compact('nilai_mahasiswa'));   
    }
     public function create(){

     return view('nilai-mahasiswa.create');   
    }
     public function edit(){

     return view('nilai-mahasiswa.edit');   
    }
}
