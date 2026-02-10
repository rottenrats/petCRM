<?php

namespace App\Services\Company;

use App\Models\Account;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterCompanyService 
{
    public function handle(array $data): User
    {
        return DB::transaction(function () use($data) {

            $company = Company::create([
                'name' => $data['company_name'],
                'inn' => $data['company_inn'],
                'legal_address' => $data['company_legal'],
                'actual_address' => $data['company_actual'],
                'phone' => $data['company_phone'],
                'email' => $data['company_email'],
            ]);

            $owner = User::create([
                'name' => $data['user_name'],
                'email' => $data['user_email'],
                'password' => Hash::make($data['password']),
                'company_id' => $company->id,
                'role' => User::ROLE_OWNER,
            ]);
            Account::create([
                'company_id' => $company->id,
                'name' => 'Основной счёт',
                'balance' => 0,
                'is_active' => true,
            ]);

            return $owner;
        });
    }
}