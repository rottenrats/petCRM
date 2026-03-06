<?php

namespace App\Services\User;

use App\Models\User;

class UpdateUserService
{
    public function handle(User $user, array $data):User 
    {
        $user->update([
            'name' => $data['name'],
            'email' =>$data['email'],
        ]);

        return $user;
    }
}