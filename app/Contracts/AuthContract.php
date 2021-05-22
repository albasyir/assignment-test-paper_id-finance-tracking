<?php

namespace App\Contracts;

use \Illuminate\Contracts\Auth\Authenticatable;

interface AuthContract
{
    /**
     * After `$credentials` passed, AuthContract will know
     * the user that we want
     *
     * generally we `use a username and password for http`
     * and we `use id for internal only`
     *
     * @param array $credentials
     * @return bool|array
     */
    public function login(array $credentials): bool | array;

    /**
     * `User session` will `forgeted by` our server after this function
     * run
     *
     * @return bool
     */
    public function logout(): bool;

    /**
     * Get current user session
     *
     * @return Authenticatable
     */
    public function user(): Authenticatable | null;
}
