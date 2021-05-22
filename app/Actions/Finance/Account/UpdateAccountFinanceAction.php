<?php

namespace App\Actions\Finance\Account;

use App\Exceptions\UpdateExpection;
use App\Models\Finance\Account;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\MassAssignmentException;

class UpdateAccountFinanceAction
{
    private Account $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     *
     *
     * @param array $attributes
     * @return true
     * @throws MassAssignmentException
     * @throws UpdateExpection
     */
    public function save(array $attributes)
    {
        $this->account->fill($attributes);

        return $this->account->saveOrFail();
    }
}
