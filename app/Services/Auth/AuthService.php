<?php

namespace App\Services\Auth;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function __construct(public UserService $userService)
    {
    }

    public function login(array $data): array
    {
        $credentials = ['email' => $data['email'], 'password' => $data['password']];
        $remember_me = isset($data['remeber_me']) ? true : false;
        $user = $this->userService->getUserByEmail($data['email']);
        if (is_null($user))
            return ['status' => 'error', 'message' => 'Yanlış giriş məlumatları', 'redirect' => redirect()->back()];
        $authAttempt = Auth::attempt($credentials, $remember_me);
        if (!$authAttempt)
            return ['status' => 'error', 'message' => 'Yanlış giriş məlumatları', 'redirect' => redirect()->back()];

        return [
            'status' => 'success',
            'message' => 'Uğurla daxil oldunuz',
            'redirect' => redirect()->route('admin.dashboard'),
        ];
    }

    public function update_profile(array $data): array
    {
        try {
            $user = $this->userService->getById(auth()->id());
            $data['password'] = isset($data['password']) ? bcrypt($data['password']) : $user->password;
            $this->userService->update($user->id, $data);
            return ['status' => 'success', 'message' => 'Profil məlumatları uğurla yeniləndi'];
        } catch (\Exception $ex) {
            return ['status' => 'error', 'message' => $ex->getMessage()];
        }
    }

    public function logout(): array
    {
        Auth::logout();
        Session::regenerateToken();
        Session::flush();
        return [
            'status' => 'success',
            'message' => 'Uğurla çıxış etdiniz',
            'redirect' => redirect()->route('login'),
        ];
    }
}
