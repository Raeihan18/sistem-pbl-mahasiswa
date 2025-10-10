<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ControllerUser extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        // arahkan ke halaman tambah user
        return view('user.create');
    }

    public function store(Request $request)
    {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect('user/index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
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

        return redirect('user/index')->with('success', 'Data user berhasil diupdate!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('user/index')->with('success', 'User berhasil dihapus!');
    }
}
