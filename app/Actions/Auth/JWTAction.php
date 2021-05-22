<?php

namespace App\Actions\Auth;

use App\Contracts\AuthContract;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAction implements AuthContract
{
    /**
     *
     *
     * @param array $credentials
     * @return array
     * @throws AuthenticationException
     */
    public function login(array $credentials): array
    {
        $token = auth()->attempt($credentials);

        if (!$token) throw new AuthenticationException();

        return [
            'type' => 'bearer',
            'token' => $token,
            'identity' => auth()->user()
        ];
    }



    public function logout(): bool
    {
        if (!auth()->check()) throw new UnauthorizedException("fail when action check the session");

        auth()->logout();

        return true;
    }



    public function user(): Authenticatable | null
    {
        return auth()->user();
    }
}
