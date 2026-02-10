<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- ===== COMPANY ===== --}}
        <h2 class="text-lg font-semibold mb-4">Компания</h2>

        <div>
            <x-input-label for="company_name" value="Название компании" />
            <x-text-input id="company_name" name="company_name" type="text"
                class="block mt-1 w-full" value="{{ old('company_name') }}" required />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_inn" value="ИНН" />
            <x-text-input id="company_inn" name="company_inn" type="text"
                class="block mt-1 w-full" value="{{ old('company_inn') }}" required />
            <x-input-error :messages="$errors->get('company_inn')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_email" value="Email компании" />
            <x-text-input id="company_email" name="company_email" type="email"
                class="block mt-1 w-full" value="{{ old('company_email') }}" required />
            <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_phone" value="Телефон компании" />
            <x-text-input id="company_phone" name="company_phone" type="text"
                class="block mt-1 w-full" value="{{ old('company_phone') }}" />
            <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_legal" value="Юридический адрес" />
            <x-text-input id="company_legal" name="company_legal" type="text"
                class="block mt-1 w-full" value="{{ old('company_legal') }}" />
            <x-input-error :messages="$errors->get('company_legal')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_actual" value="Фактический адрес" />
            <x-text-input id="company_actual" name="company_actual" type="text"
                class="block mt-1 w-full" value="{{ old('company_actual') }}" />
            <x-input-error :messages="$errors->get('company_actual')" class="mt-2" />
        </div>

        {{-- ===== OWNER ===== --}}
        <h2 class="text-lg font-semibold mt-8 mb-4">Владелец</h2>

        <div>
            <x-input-label for="user_name" value="Имя" />
            <x-text-input id="user_name" name="user_name" type="text"
                class="block mt-1 w-full" value="{{ old('user_name') }}" required />
            <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="user_email" value="Email" />
            <x-text-input id="user_email" name="user_email" type="email"
                class="block mt-1 w-full" value="{{ old('user_email') }}" required />
            <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Пароль" />
            <x-text-input id="password" name="password" type="password"
                class="block mt-1 w-full" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Подтверждение пароля" />
            <x-text-input id="password_confirmation" name="password_confirmation"
                type="password" class="block mt-1 w-full" required />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900"
               href="{{ route('login') }}">
                Уже есть аккаунт?
            </a>

            <x-primary-button class="ms-4">
                Зарегистрировать компанию
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
