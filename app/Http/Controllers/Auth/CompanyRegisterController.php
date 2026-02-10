<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterCompanyRequest;
use App\Services\Company\RegisterCompanyService;
use Illuminate\Support\Facades\Auth;


class CompanyRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-company');
    }

    public function store(
        RegisterCompanyRequest $request,
        RegisterCompanyService $service
    )
    {
        $owner = $service->handle($request->validated());

        Auth::login($owner);

        return redirect()->route('dashboard');
    }
}