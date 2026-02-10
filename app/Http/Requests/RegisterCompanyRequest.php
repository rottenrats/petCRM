<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterCompanyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //company 
            'company_name' => ['required', 'string', 'max:255'],
            'company_inn' => ['required', 'string', 'max:12', 'unique:companies,inn'],
            'company_email' => ['required', 'email', 'unique:companies,email'],
            'company_phone' => ['nullable', 'string'],
            'company_legal' => ['required', 'string'],
            'company_actual' => ['required', 'string'],

            //owner
            'user_name' => ['required', 'string', 'max:255'],
            'user_email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function authorize(): bool 
    {
        return true;
    }
}
