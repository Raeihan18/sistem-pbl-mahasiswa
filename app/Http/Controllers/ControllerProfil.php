<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\User;
use App\Models\MataKuliah;




class ControllerProfil extends Controller
{
    public function index()
    {
        $authUser = auth()->user();
        $id_user = $authUser->id_user;


        // ambil profil berdasarkan id_user
        $profil = Profil::where('id_user', $id_user)->firstOrFail();


        // ambil mata kuliah yang diampu (jika relasi sudah dibuat)
        $matkul_dosen = $authUser->matkul()->get();
        $title = 'Profil';


        return view('dosen.profil.index', compact('profil', 'authUser', 'matkul_dosen', 'title'));
    }


    public function edit($id_user)
    {
        // ambil profil berdasarkan id_user
        $profil = Profil::where('id_user', $id_user)->firstOrFail();


        // ambil semua mata kuliah dari tabel matkul
        $matkul = MataKuliah::all();
        $title = 'Profil';

        return view('dosen.profil.edit', compact('profil', 'matkul', 'title'));
    }


    public function update(Request $request, string $id_profil)
    {
        $profil = Profil::findOrFail($id_profil);
        $user = auth()->user();


        // Update data dasar profil
        $dataUpdate = [
            'NIP' => $request->NIP,
        ];


        // Upload foto baru jika ada
        if ($request->hasFile('potoprofil')) {
            // hapus foto lama jika ada
            if ($profil->potoprofil && Storage::exists('potoprofil/' . $profil->potoprofil)) {
                Storage::delete('potoprofil/' . $profil->potoprofil);
            }


            // simpan foto baru
            $potoprofil = $request->file('potoprofil');
            $potoprofil->storeAs('potoprofil', $potoprofil->hashName());
            $dataUpdate['potoprofil'] = $potoprofil->hashName();
        }


        // Simpan update profil
        $profil->update($dataUpdate);


        // Simpan relasi mata kuliah (checkbox)
        if ($request->has('matkul')) {
            $user->matkul()->sync($request->matkul);
        }


        return redirect('/dosen/profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
