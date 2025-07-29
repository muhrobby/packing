<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store(UserRequest $request){
        $validate = $request->validated();

        // dd($request);
        // dd($validate);
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password'=> Hash::make($validate['password']),
                'nik' => $validate['nik'],
                'store_code'=> $validate['store_code'],
            ]);

            $user->assignRole($validate['role']);
            
            // dd($user);

            DB::commit();

        //             // --- DEBUGGING LINE ---
        // $redirectUrl = route('user.create'); // Get the intended URL
        // \log::info("Redirecting to: " . $redirectUrl); // Log it
        // // Or for direct output during test run:
        // dd($redirectUrl); // This will halt the test and show the URL
        // // --- END DEBUGGING ---

            return redirect()->route('user.create');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            dd($e->getMessage()); 

            return redirect()->back();
        }

    }
}
