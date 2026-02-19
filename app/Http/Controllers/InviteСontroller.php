<?php

namespace App\Http\Controllers;

use App\Services\Invite\CreateInviteService;
use App\Http\Requests\InviteRequest;
use App\Models\User;

class InviteСontroller extends Controller
{
    public function create()
    {
        $user = auth()->user();

        $roles = [];

        if ($user->role === User::ROLE_OWNER) {
            $roles = [User::ROLE_ADMIN, User::ROLE_USER];
        } elseif ($user->role === User::ROLE_ADMIN) {
            $roles = [User::ROLE_USER];
        }

        return view('invites.invite', compact('roles'));
    }

    public function store(
        InviteRequest $request,
        CreateInviteService $service
    )
    {
        $user = auth()->user();
        $data = $request->validated();

        \Log::info('User role: ' . $user->role);
        \Log::info('Selected role from form: ' . $data['role']);

        if(!$user->canInvite($data['role'])) {
            return back()->withErrors(['role'=>'Недостаточно прав для назначения этой роли.']);
        }

        $service->handle($user, $data);

        return  redirect()
            ->route('invite.create.show')
            ->with('success', 'приглашение отправлено');
    }
}
