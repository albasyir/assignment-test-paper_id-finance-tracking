<?php

namespace App\Actions\Auth;

use App\Contracts\AuthContract;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * JWT Auth Action
 *
 * NOTE: this use defult guard, if we change default guard,
 * this package need small change
 *
 * @package App\Actions\Auth
 */
class JWTAction implements AuthContract
{
    /**
     * Login with JWT
     *
     * @param array $credentials
     * @return array
     * @throws AuthenticationException
     */
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

    /**
     * Logout with JWT
     *
     * @return bool
     * @throws AuthenticationException
     */
    public function logout(): bool
    {
        if (!Auth::check()) throw new AuthenticationException("fail when action check the session");

        Auth::logout();

        return true;
    }


    /**
     * User Session
     *
     * @return Authenticatable|null
     * @throws AuthenticationException
     */
    public function user(): Authenticatable | null
    {
        if (!Auth::check()) throw new AuthenticationException("fail when action check the session");

        return Auth::user();
    }
}
