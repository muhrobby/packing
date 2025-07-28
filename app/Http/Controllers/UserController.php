<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);

        return response()->json($users);
    }
    public function create(){

        return Inertia::render('user/create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3|string',
            'nik' => 'required|max:7|string|unique:'.User::class,
            'password'=> 'required|confirmed'
        ]);
        
        $user = User::create([
            'name'=> $request->name,
            'nik' => $request->nik,
            'password'=> Hash::make($request->password)
        ]);

        event(new Registered($user));


        return response()->json($user);
    }
}
