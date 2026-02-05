<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $type = fake()->randomElement(['income', 'expense']);

        return [
            'amount' => fake()->randomFloat(2, 100, 50000),
            'currency' => 'RUB',
            'type' => $type,
            'date' => fake()->dateTimeThisMonth(),
            'is_recurring' => fake()->boolean(10),
        ];
    }
}
