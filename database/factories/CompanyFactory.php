<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'inn' => fake()->unique()->numerify('############'),
            'type' => fake()->randomElement(['ООО', 'ИП', 'АО']),
            'legal_address' => fake()->address(),
            'actual_address' => fake()->optional()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Company $company) {
            Account::factory()->create([
                'company_id' => $company->id,
            ]);

            Budget::factory()->count(2)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
