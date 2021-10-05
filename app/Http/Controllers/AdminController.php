<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{
    public function index(){
        return view('home');
    }
    public function getAdmin(){
        return view('gettingAdmin');
    }
    public function getAdmin_processing(Request $req){
        $input_key = $req->input('keyword');
        if($input_key === "12345678"){
            $user = User::find(Auth::user()->id);
            $user->isAdmin = true;
            $user->save();
            return redirect()->route('Home');
        }else{
            throw ValidationException::withMessages(['error_key' => 'This value is incorrect']);
        }
        
    }
}
