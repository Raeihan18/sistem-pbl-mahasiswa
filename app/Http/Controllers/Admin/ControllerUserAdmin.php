<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ControllerUserAdmin extends Controller
{
    public function index()
    {
        $users = User::all();
        $title = 'User';
        return view('admin.user.index', compact('users', 'title'));
    }

    public function create()
    {
        // arahkan ke halaman tambah user
        $title = "Tambah User";
        return view('admin.user.create', compact('title'));
    }

    public function store(Request $request)
    {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect('admin/user')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $title = "Edit Data User";
        return view('admin.user.edit', compact('user', 'title'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->level = $request->level;
        $user->save();        
        return redirect('admin/user')->with('success', 'Data user berhasil diupdate!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('user/index')->with('success', 'User berhasil dihapus!');
    }
}
