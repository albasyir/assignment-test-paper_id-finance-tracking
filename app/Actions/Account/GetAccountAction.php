<?php

namespace App\Actions\Account;

use App\Models\Account;
use Illuminate\Http\Request;

class GetAccountAction extends Account
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter()
    {
        if (!$this->request) return $this;

        $filterByName = $this->request->query('name');
        if ($filterByName) $this->query()->where('name', 'like', "%{$filterByName}%");
    }
}
