<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use Illuminate\Http\Request;

/**
 * Account Controller
 *
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * Display a listing of current user session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AuthContract $auth)
    {
        $accounts = $auth->user()->accounts();

        if ($request->has('name')) {
            $accounts->where('name', 'like', "%{$request->input('name')}%");
        }

        return $accounts->paginate(15);
    }

    /**
     * Store a newly created finance account in storage for current user session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AuthContract $auth)
    {
        return $auth->user()->accounts()->create($request->only('name'));
    }

    /**
     * Display the specified account from current user session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, AuthContract $auth)
    {
        return $auth->user()->accounts()->findOrFail($id);
    }

    /**
     * Update finance account for current user session
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id, AuthContract $auth)
    {
        return $auth->user()->accounts()->findOrFail($id)->update($request->only('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, AuthContract $auth)
    {
        return $auth->user()->accounts()->findOrFail($id)->delete();
    }
}
