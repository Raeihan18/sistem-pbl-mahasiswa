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
     public function edit(){

     return view('user.edit');   
    }

}