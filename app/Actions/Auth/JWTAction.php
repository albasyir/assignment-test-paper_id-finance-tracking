<?php

namespace App\Actions\Auth;

use App\Contracts\AuthContract;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class JWTAction implements AuthContract
{
    public function login(array $credentials): array
    {
        $token = Auth::attempt($credentials);

        if (!$token) throw new AuthenticationException();

        return [
            'type' => 'bearer',
            'token' => $token,
            'identity' => Auth::user()
        ];
    }

    public function logout(): bool
    {
        if (!Auth::check()) throw new AuthenticationException("fail when action check the session");

        Auth::logout();

        return true;
    }


    public function user(): Authenticatable | null
    {
        if (!Auth::check()) throw new AuthenticationException("fail when action check the session");

        return Auth::user();
    }
}
