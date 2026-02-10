<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class InviteRegisterController extends Controller
{

    public function show(string $token)
    {
        $invite = Invite::valid()
            ->where('token', $token)
            ->firstOrFail();

        return view('auth.invite-register', compact('invite'));
    }

    public function store(Request $request, string $token)
    {
        $invite = Invite::valid()
            ->where('token', $token)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::default()],

        ]);

        DB::transaction(function () use ($invite, $validated, &$user) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $invite->email,
                'password' => Hash::make($validated['password']),
                'company_id' => $invite->company_id,
                'role' => $invite->role,
            ]);

            $invite->markAsUsed();
        });

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
