<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;


class LoginController extends Controller
{
    public function login(LoginRequest $r){

        if(Auth::attempt(['email'=> $r->email, 'password'=>$r->pass], true)){
            return true;
        } else {
            return response()->json(['errors' => ['from' => 'Не правильный логин или пароль!']], 401);
        }

    }

    public function logout(){

        Auth::logout();

        return redirect()->route('home');

    }
}
