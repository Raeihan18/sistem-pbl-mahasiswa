<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaTerbaik;
use App\Models\Bobot;
use Illuminate\Http\Request;

class ControllerTpk extends Controller
{
        public function index(){
        $mahasiswas = MahasiswaTerbaik::all();

        // $mahasiswas = MahasiswaTerbaik::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')->get();


        // dd($mahasiswas);
        $title = 'TPK';
        return view('admin.tpk.index',compact('mahasiswas','title'));
    }

        public function bobot(){
        $bobots = Bobot::all();
        $title = 'Bobot';
        return view('admin.tpk.bobot.index',compact('bobots','title'));
    }
}
