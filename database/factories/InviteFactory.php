<?php

namespace Database\Factories;

use App\Models\Invite;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InviteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'role' => Invite::ROLE_USER,
            'token' => Str::uuid(),
            'expires_at' => now()->addDays(3),
        ];
    }
}