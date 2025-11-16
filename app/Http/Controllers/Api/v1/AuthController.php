<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService ){
        $this->authService = $authService;
    }
}
