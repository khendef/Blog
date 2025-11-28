<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\api\v1\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Services\v1\Auth\AuthService;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService ){
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request){
        $data = $this->authService->register($request->validated());
        return self::success($data , 'registered successfully' , 201);
    }


    public function login(LoginRequest $request){
        $data = $this->authService->login($request->validated());
        if($data['status']==='error'){
            return self::error('invalid credentials',401,$data);
        }
        return self::success($data,'successfully logged in');

    }

    public function logout(){

        auth()->guard('api')->logout();
        return self::success(null,'Successfully logged out');
    }

    public function profile(){
         return self::success(auth()->user());
    }

    public function refresh(){
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);
        $data = [
            'status'=>'success',
            'user'=>auth()->user(),
            'token'=>$token
        ];
        return self::success($data);
    }
}
