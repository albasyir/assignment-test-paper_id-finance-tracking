<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private Authenticatable $user;

    public function __construct(AuthContract $auth)
    {
        $this->user = $auth->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->transactions()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->user->transactions()->create($request->only(['name', 'amount', 'account_id']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->user->transactions()->findOrFail($id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        return $this->user->transactions()->findOrFail($id)->update($request->only(['name', 'amount']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->user->transactions()->findOrFail($id)->delete();
    }
}
