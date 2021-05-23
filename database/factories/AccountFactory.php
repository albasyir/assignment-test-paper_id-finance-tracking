<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::query()->inRandomOrder()->first(['id']);

        return [
            'name' => "Bank " . $this->faker->bankAccountNumber,
            'user_id' => $user->id,
            'created_at' => $this->faker->dateTimeBetween()
        ];
    }
}
