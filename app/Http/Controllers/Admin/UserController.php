<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('company_id', Auth::user()->company_id)
            ->where('id', '!=', Auth::id()) // можно убрать если нужно
            ->get();

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }
    
    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUserService $service
    )
    {
        $this->authorize('update', $user);

        $service->handle($user, $request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated');
    }
}
