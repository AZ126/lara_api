<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balance' => fake()->randomFloat(2, 0, 10000),
            'currency' => fake()->currencyCode(),
            'user_id' => fn () => User::inRandomOrder()->first()?->id ?? User::factory(),
            'uuid' => fake()->uuid(),
            'status' => 'active',
        ];
    }
}
