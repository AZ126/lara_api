<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),

            // Link to existing records or fallback to new ones
            'transaction_id' => Transaction::inRandomOrder()->first()?->id ?? Transaction::factory(),
            'sender_user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            // Receiver Details
            'receiver_name' => fake()->name(),
            'receiver_country' => fake()->countryCode(), // Returns 2-letter ISO code
            'receiver_account' => fake()->bankAccountNumber(),

            // Currency and Forex
            'exchange_rate' => fake()->randomFloat(6, 0.5, 150),
            'source_currency' => fake()->currencyCode(),
            'target_currency' => fake()->currencyCode(),

            // Status
            'status' => fake()->randomElement(['initiated', 'processing', 'completed', 'failed']),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State for a completed transfer.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
        ]);
    }
}
