<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $account = Account::query()->inRandomOrder()->first(['id']);

        return [
            'name' => $this->faker->word,
            'amount' => rand(-500000, 500000),
            'account_id' => $account->id,
            'created_at' => $this->faker->dateTimeBetween()
        ];
    }
}
