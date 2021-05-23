<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AuthContract $auth)
    {
        $transactions = $auth->user()->transactions();

        if ($request->has('name')) {
            $transactions->where('transactions.name', 'like', "%{$request->input('name')}%");
        }

        if ($request->has('amount_min') && $request->has('amount_max')) {
            $transactions->whereBetween('amount', [
                $request->input('amount_min'),
                $request->input('amount_max')
            ]);
        }

        if ($request->has('account_id')) {
            $transactions->where('account_id', '=', $request->input('account_id'));
        }

        return $transactions->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AuthContract $auth)
    {
        $auth->user()->accounts()->findOrFail($request->input('account_id'));

        return $auth->user()->transactions()->create($request->only(['name', 'amount', 'account_id']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, AuthContract $auth)
    {
        return $auth->user()->transactions()->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id, AuthContract $auth)
    {
        return $auth->user()->transactions()->findOrFail($id)->update($request->only(['name', 'amount']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, AuthContract $auth)
    {
        return $auth->user()->transactions()->findOrFail($id)->delete();
    }
}
