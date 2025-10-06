<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerNilaiMahasiswa extends Controller
{
    public function index(){

     return view('nilai-mahasiswa.index');   
    }
     public function create(){

     return view('nilai-mahasiswa.create');   
    }
     public function edit(){

     return view('nilai-mahasiswa.edit');   
    }
}
