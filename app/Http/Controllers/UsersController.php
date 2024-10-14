<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function index() {
        // $user = DB::select("SELECT * FROM user");
        // dd($user);
        $user = User::all();
        //dd($user);
        return view('users.index',['user' => $user]);
}
    public function create(){
        return view('users.create');
    }
    
    public function store(Request $request){
        $user = new User();
        $user->department_id = $request->input('department_id');
        $user->fullname = $request->input('fullname');
        $user->phone = $request->input('phone');
        $user->adress = $request->input('adress');
        $user->dob = $request->input('dob');
        $user->username = $request->input('username');
        $user->password = $request->input('password');

        $user->save();
        return redirect('/users');
    }

    public function edit($id){
        $user = User::find($id);
        //dd($user);
        return view('users.edit')->with('user',$user);
    }

    public function update(Request $request, $id){
        $user = User::where('id',$id)->
        update([
        'department_id' => $request->input('department_id'),
        'fullname' => $request->input('fullname'),
        'phone' => $request->input('phone'),
        'adress' => $request->input('adress'),
        'dob' => $request->input('dob'),
        'username' => $request->input('username'),
        'password' => $request->input('password'),
        ]);
        return redirect('/users');
    }
}