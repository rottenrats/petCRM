<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_and_owner_can_be_registered(): void
    {
        $response = $this->post('/register', [
            'company_name' => 'ООО Рога и Копыта',
            'company_inn' => '123456789012',
            'company_email' => 'company@test.ru',
            'company_phone' => '+79999999999',
            'company_legal' => 'Москва',
            'company_actual' => 'Москва',

            'user_name' => 'Owner',
            'user_email' => 'owner@test.ru',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('companies', [
            'inn' => '123456789012',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'owner@test.ru',
            'role' => User::ROLE_OWNER,
        ]);

        $this->assertDatabaseHas('accounts', [
            'name' => 'Основной счёт',
        ]);

        $this->assertAuthenticated();
    }
}
