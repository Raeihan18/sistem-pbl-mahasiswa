<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ControllerUser extends Controller
{
    public function index(){ 

        $users = User::all();

     return view('user.index', compact('users'));
}

public function create(){

     return view('user.create');   
    }

public function store(Request $request){

    User::create([
    'nama'=> $request->nama,
    'email'=> $request->email,
    'password'=>bcrypt($request->password),
    'level'=> $request->level,
]); 

return redirect('dosen/user');  
      
    }
     public function edit(){

     return view('user.edit');   
    }

    public function delete($id_user){
        $user = User::find($id_user);
        $user->delete();

        return redirect('/dosen/user'); 

    }

}