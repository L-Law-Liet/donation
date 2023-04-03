<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginService $service)
    {
        return $service->login($request->validated());
    }
}
