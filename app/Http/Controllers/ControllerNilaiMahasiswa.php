<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;


class ControllerNilaiMahasiswa extends Controller
{
    public function index(){
       $nilai_mahasiswa = NilaiMahasiswa::leftJoin('mahasiswa', 'nilai_mahasiswa.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
    ->leftJoin('matkul', 'nilai_mahasiswa.id_matkul', '=', 'matkul.id_matkul')
    ->leftJoin('kelompok', 'mahasiswa.id_kelompok', '=', 'kelompok.id_kelompok')
    ->select('nilai_mahasiswa.*', 'mahasiswa.nama as nama_mahasiswa', 'matkul.nama_matkul', 'kelompok.nama_kelompok')
    ->get();
    


        return view('nilai-mahasiswa.index', compact('nilai_mahasiswa'));   
    }
     public function create(){
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

     return view('nilai-mahasiswa.create', compact('mahasiswa','mataKuliah'));   
    }
        public function store(Request $request){
            
            // Simpan data
            NilaiMahasiswa::create($request->all());
    
            return redirect('/dosen/nilai-mahasiswa')->with('success', 'Nilai mahasiswa berhasil ditambahkan.');
    }
     public function edit($id_nilai_mahasiswa){

        $nilai = NilaiMahasiswa::find($id_nilai_mahasiswa);
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();

     return view('nilai-mahasiswa.edit', compact('nilai', 'mahasiswa','mataKuliah'));   
    }
     public function update(Request $request, $id_nilai_mahasiswa){
    
        $nilai_mahasiswa = NilaiMahasiswa::find($id_nilai_mahasiswa);
        $nilai_mahasiswa->update($request->all());
    
     return redirect('/dosen/nilai-mahasiswa')->with('success', 'Nilai mahasiswa berhasil diperbarui.');
    }

    public function delete($id_nilai_mahasiswa){

        $nilai_mahasiswa = NilaiMahasiswa::find($id_nilai_mahasiswa);
        $nilai_mahasiswa->delete();

        return redirect('/dosen/nilai-mahasiswa');
    }
}
