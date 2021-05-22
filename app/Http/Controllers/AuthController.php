<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Contracts\AuthContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, AuthContract $auth)
    {
        return $auth->login($request->only('email', 'password'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request, AuthContract $auth)
    {
        $auth->logout();

        return response([], Response::HTTP_NO_CONTENT);
    }


    /**
     * register new user
     *
     * @param Request $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        $user = new User($request->only('name', 'email', 'password'));

        $user->saveOrFail();

        return $user;
    }

    public function user(AuthContract $auth)
    {
        return $auth->user();
    }
}
