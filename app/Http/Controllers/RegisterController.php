<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;

class RegisterController extends Controller
{

    public function profileRedirect(){
        return view('profile');
    }

    public function registration(RegistrationRequest $r){

        if ($r -> pass1 == $r -> pass2) {
            User::create([
                'name' => $r -> name,
                'email' => $r -> email,
                'password' => Hash::make($r->pass1)
            ]);
    
            return response()->json(['success'=>'Регистрация успешна!']);
        } else {
            return response()->json(['error'=>'Пароли не совпадают']);
        }


    }
}
