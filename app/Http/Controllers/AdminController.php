<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getUsers(){
        $users = User::all(["id","name", "email"]); 
        return view('admin.UserList',compact( 'users'));
    }
}
