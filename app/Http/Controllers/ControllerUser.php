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

public function update(request $request, $id_user){

        $user = User::find($id_user);
        $user->nama = $request->nama;
         $user->email = $request->email;
         if($request->password){
            $user->password = bcrypt(request->password);
         };
    
    $user->level = $request->level;
    $user->save();

    return redirect('/dosen/user')->with('succes', 'User berhasil diupdate');
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
     public function edit($id_user){

       $user = User::find($id_user);  


     return view('user.edit',compact("user"));   
    }

    public function delete($id_user){
        $user = User::find($id_user);
        $user->delete();

        return redirect('/dosen/user'); 

    }

}