<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Company;
use App\Models\User;
use App\Models\Account;
use App\Models\Budget;
use App\Models\Transaction;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()
            ->count(3)
            ->create()
            ->each(function (Company $company) {

                $owner = User::factory()->create([
                    'company_id' => $company->id,
                    'role' => User::ROLE_OWNER,
                ]);

                User::factory()->count(4)->create([
                    'company_id' => $company->id,
                    'role' => User::ROLE_USER,
                ]);

                $accounts = Account::factory()->count(3)->create([
                    'company_id' => $company->id,
                ]);

                $budgets = Budget::factory()->count(2)->create([
                    'company_id' => $company->id,
                ]);

                Transaction::factory()->count(20)->create([
                    'company_id' => $company->id,
                    'user_id' => $owner->id,
                    'account_id' => $accounts->random()->id,
                    'budget_id' => $budgets->random()->id,
                ]);

                Invite::factory()->count(2)->create([
                    'company_id' => $company->id,
                ]);
            });
    }
}
