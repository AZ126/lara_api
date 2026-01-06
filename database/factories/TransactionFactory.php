<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(6, 10, 5000);
        $fee = $amount * 0.02; // Example 2% fee
        $type = fake()->randomElement(['debit', 'credit']);

        return [
            'uuid' => (string) Str::uuid(),
            'reference' => 'TRX-' . strtoupper(Str::random(10)),

            // Randomly assign to existing users/wallets or create new ones if empty
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'wallet_id' => Wallet::inRandomOrder()->first()?->id ?? Wallet::factory(),
            'type' => $type,
            'amount' => $amount,
            'fee' => $fee,
            'net_amount' => $type === 'credit' ? $amount - $fee : $amount + $fee,
            'status' => fake()->randomElement(['pending', 'completed', 'failed', 'reversed']),
            'idempotency_key' => Str::random(32),
            'meta' => [
                'ip_address' => fake()->ipv4(),
                'user_agent' => fake()->userAgent(),
                'note' => fake()->sentence()
            ],
        ];
    }

    /**
     * State for a completed transaction.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
        ]);
    }
}
