<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function index(){
        return view('admins.index');
    }

    public function login(){
        return view('admins.login');
    }

    public function check_login(){
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        
        $data = request()->all('username', 'password');
        //if(auth()->attempt($data)){
            return redirect()->route('index');
        //}
        //return redirect()->back();
        
    }
}
