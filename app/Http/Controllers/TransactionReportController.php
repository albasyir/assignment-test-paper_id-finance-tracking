<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;

class TransactionReportController extends Controller
{
    public function daily(AuthContract $auth)
    {
        return $auth->user()->transactions()->get();
    }

    public function monthly(AuthContract $auth)
    {
        return $auth->user()->transactions()->get();
    }
}
