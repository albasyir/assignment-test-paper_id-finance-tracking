<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Generate report for user
     *
     * @param Request $request
     * @param AuthContract $auth
     * @return mixed
     */
    public function transaction(Request $request, AuthContract $auth)
    {
        $period_start = $request->input('period_start', now()->subYear());
        $period_end = $request->input('period_end',  now());
        $type = $request->input('type', 'daily');

        $transactions = $auth->user()->transactions();

        if ($type == 'monthly') {
            $transactions->groupByMonth();
        } else {
            $transactions->groupByDay();
        }

        $transactions->whereBetween('transactions.created_at', [$period_start, $period_end]);

        return $transactions->get();
    }
}
