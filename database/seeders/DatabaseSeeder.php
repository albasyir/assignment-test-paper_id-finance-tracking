<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AccountSeeder::class,
            TransactionSeeder::class
        ]);

        $random_user = User::query()->inRandomOrder()->first(['email']);

        $this->command->info('Want test account? you can use : ' . $random_user->email . ' with "testaccount" as password');
    }
}
