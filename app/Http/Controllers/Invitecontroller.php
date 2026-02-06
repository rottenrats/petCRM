<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Mail\InviteMail;

use Illuminate\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Invitecontroller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'role' => ['required', 'in:admin, user'],
        ]);

        $invite = Invite::create([
            'company_id' => auth()->user()->company_id,
            'email' => $request->email,
            'role' => $request->role,
            'token' => Str::uuid(),
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($invite->email)->send(
            new InviteMail($invite)
        );
    }
}
