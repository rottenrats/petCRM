<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Маркетинг', 'Зарплаты', 'Операционные']),
            'amount' => fake()->randomFloat(2, 10000, 300000),
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->endOfMonth(),
        ];
    }
}
