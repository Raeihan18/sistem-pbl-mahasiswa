<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\User;

class ControllerProfil extends Controller
{
     public function index()
    {
            // Data dummy, nanti bisa diambil dari session/auth
            // $profil = [
            //     'nama' => 'Dr. Ahmad Khaidir',
            //     'nidn' => '1234567890',
            //     'email' => 'ahmad.khaidir@universitas.ac.id',
            //     'matkul' => ['Pemrograman Web', 'Basis Data', 'PBO'],
            //     'foto' => 'default-avatar.png' // letakkan di public/images/
            // ];
            $authUser = auth()->user();
            $id_user = $authUser->id_user;
            // dd($id_user);
        $profil = Profil::findOrFail($id_user);

        // // $profil = $profil->where('id_user', session('id_user'))->first();
        // dd($profil);
        return view('profil.index', compact('profil'));
    }
    public function edit($id_user){

        $profil = DB::table('profil');
        $profil = $profil->where('id_user', $id_user)->first();
        // dd($profil);
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request, string $id_profil){
        // dd($request->all());
        $profil = Profil::find($id_profil);
        $profil->NIP = $request->NIP;
        $profil->matakuliah = $request->matakuliah;
        // if($request->gambar){
        //     $profil->gambar = $request->gambar;
        // }
       if($request->hasFile('potoprofil')){
            //hapus foto lama
            Storage::delete('potoprofil/'.$profil->potoprofil);
            //upload foto baru  
        $potoprofil = $request->file('potoprofil');
        $potoprofil->storeAs('potoprofil',$potoprofil->hashName()); 

        $profil->update([
            'potoprofil' => $potoprofil->hashName(),
            'NIP' => $request->NIP,
            'matakuliah' => $request->matakuliah,
        ]);    

        }
        
        //    $profil->save();
 return redirect('/dosen/profil')->with('success', 'Profil berhasil diperbarui.');

    //         $profil = Profil::find($id_profil);
    //         $mahasiswa->nim = $request->nim;
    //         $mahasiswa->nama = $request->nama;
    //         $mahasiswa->kelas = $request->kelas;
    //         $mahasiswa->id_kelompok = $request->id_kelompok;
    //         $mahasiswa->email = $request->email;
    //         if($request->password){
    //             $mahasiswa->password = bcrypt($request->password);
    //         }
    //         $mahasiswa->save();
    //  return redirect('/dosen/mahasiswa')->with('success', 'Mahasisiwa berhasil diperbarui.');
    }

}
