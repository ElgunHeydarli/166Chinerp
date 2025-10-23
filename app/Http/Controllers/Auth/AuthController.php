<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\LoginRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $response = $this->authService->login($data);
        toastr($response['message'], $response['status']);
        return $response['redirect'];
    }

    public function logout()
    {
        $response = $this->authService->logout();
        toastr($response['message'], $response['status']);
        return $response['redirect'];
    }
}
