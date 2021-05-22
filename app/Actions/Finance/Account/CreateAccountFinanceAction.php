<?php

namespace App\Actions\Finance\Account;

use App\Models\Finance\Account;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateAccountFinanceAction
{
    private int $user_id;

    public function __construct(int | Authenticatable $user)
    {
        $this->user_id = $user instanceof Authenticatable ? $user->id : $user;
    }

    public function set(array $value)
    {
        $finance_account = new Account();

        $finance_account->fill($value);

        $finance_account->user_id = $this->user_id;

        return $finance_account->saveOrFail();
    }
}
