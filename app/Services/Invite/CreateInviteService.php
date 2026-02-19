<?php

namespace App\Services\Invite;

use App\Models\Invite;
use App\Models\User;
use App\Mail\InviteMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateInviteService
{
    public function handle(User $author, array $data):Invite
    {
        $invite = Invite::create([
            'company_id' => $author->company_id,
            'email' => $data['email'],
            'role' => $data['role'],
            'token' => Str::uuid(),
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($invite->email)->send(
            new InviteMail($invite)
        );

        return $invite;
    }
}
