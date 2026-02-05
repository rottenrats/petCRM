<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;
use App\Models\Account;
use App\Models\Budget;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()
            ->count(3)
            ->create()
            ->each(function (Company $company) {

                // OWNER
                $owner = User::factory()->create([
                    'company_id' => $company->id,
                    'role' => User::ROLE_OWNER,
                ]);

                // ADMINS + USERS
                $users = User::factory()
                    ->count(5)
                    ->create([
                        'company_id' => $company->id,
                        'role' => User::ROLE_USER,
                    ]);

                // ACCOUNTS
                $accounts = Account::factory()
                    ->count(3)
                    ->create([
                        'company_id' => $company->id,
                    ]);

                // BUDGETS
                $budgets = Budget::factory()
                    ->count(2)
                    ->create([
                        'company_id' => $company->id,
                    ]);

                // TRANSACTIONS
                Transaction::factory()
                    ->count(20)
                    ->create([
                        'company_id' => $company->id,
                        'user_id' => $owner->id,
                        'account_id' => $accounts->random()->id,
                        'budget_id' => $budgets->random()->id,
                    ]);
            });
    }
}
