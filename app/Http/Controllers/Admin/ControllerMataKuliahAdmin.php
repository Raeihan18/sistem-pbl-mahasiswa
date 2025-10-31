<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;

class ControllerMatakuliahAdmin extends Controller
{
    public function index(){
        $mataKuliah = MataKuliah::get();
       
        return view('admin.mata-kuliah.index',compact('mataKuliah'));   
    }

    public function create(){

        return view('admin.mata-kuliah.create');   
    }

     public function store(Request $request){
        // Simpan data
        MataKuliah::create($request->all());
    
        return redirect('/admin/mata-kuliah')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function edit($id_matkul){

        $mataKuliah = Matakuliah::find($id_matkul);

     return view('admin.mata-kuliah.edit', compact('mataKuliah'));   
    }

    public function update(Request $request, $id_matkul){
    
        $mataKuliah = MataKuliah::find($id_matkul);
        $mataKuliah->update($request->all());
    
     return redirect('/admin/mata-kuliah')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function delete($id_matkul){

        $mata_kuliah = MataKuliah::find($id_matkul);
        $mata_kuliah->delete();

        return redirect('/admin/mata-kuliah')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }
}
