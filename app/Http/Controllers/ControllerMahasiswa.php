<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerNilaiMahasiswa extends Controller
{
    public function index(){

     return view('mahasiswa.index');   
    }

}
