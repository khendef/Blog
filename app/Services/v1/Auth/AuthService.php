<?php

namespace App\Services\v1\Auth;
use App\Models\User;
use Exception;


class AuthService
{

    public function register($data){

        try{
            $user = User::create($data);
            $credentials = $user->only('email', 'password');
            $token = auth()::attempt($credentials);
            return [
                'status'=>'success',
                'user'=>$user,
                'token'=>$token
            ];
        }catch(Exception $e){}
    }

    public function login($credentials){

       if (! $token = auth()->attempt($credentials)) {
            return [
                'status'=>'error',
                'user'=>null,
                'token'=>null
            ];
        }
        return [
            'status'=>'success',
            'user'=>auth()->user(),
            'token'=>$token
        ];


    }

}
