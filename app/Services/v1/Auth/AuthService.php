<?php

namespace App\Services\v1\Auth;
use App\Models\User;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


class AuthService
{

    public function register($data){

        //try{
            $user = User::create($data);
            $credentials = $user->only('email', 'password');
            if (! $token = JWTAuth::fromUser($user)) {
                 return response()->json(['error' => 'reg error'], 401);
            }
            //$token = auth('api')->attempt($credentials);
            return [
                'status'=>'success',
                'user'=>$user,
                'token'=>$token,
            ];
       // }catch(Exception $e){}
    }

    public function login($credentials){
       if (! $token = JWTAuth::attempt($credentials)) {
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
