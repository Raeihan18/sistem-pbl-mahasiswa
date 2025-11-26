<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class ControllerMatakuliah extends Controller
{
    public function index(){
        $mataKuliah = MataKuliah::get();
        $title = 'Mata Kuliah';
       
        return view('dosen.mata-kuliah.index',compact('mataKuliah','title'));   
    }

    public function create(){
        $title = 'Tambah Mata Kuliah';

        return view('dosen.mata-kuliah.create', compact('title'));   
    }

     public function store(Request $request){
        // Simpan data
        MataKuliah::create($request->all());
    
        return redirect('/dosen/mata-kuliah')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }


    
    public function edit    ($id_matkul){

        $mataKuliah = Matakuliah::find($id_matkul);
        $title = 'Edit Mata Kuliah';

     return view('dosen.mata-kuliah.edit', compact('mataKuliah','title'));   
    }

    public function update(Request $request, $id_matkul){
    
        $mataKuliah = MataKuliah::find($id_matkul);
        $mataKuliah->update($request->all());
    
     return redirect('/dosen/mata-kuliah')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function delete($id_matkul){

        $mata_kuliah = MataKuliah::find($id_matkul);
        $mata_kuliah->delete();

        return redirect('/dosen/mata-kuliah')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }
}
