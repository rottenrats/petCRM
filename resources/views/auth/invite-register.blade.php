<x-guest-layout>
    <form method="POST" action="{{ route('invite.register.store', ['token' => $invite->token]) }}">
        @csrf

        <h2 class="text-lg font-semibold mb-4">Регистрация пользователя</h2>

        {{-- Имя --}}
        <div>
            <x-input-label for="name" value="Имя" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="block mt-1 w-full"
                value="{{ old('name') }}"
                required
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email (из приглашения, readonly) --}}
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="block mt-1 w-full bg-gray-100"
                value="{{ $invite->email }}"
                readonly
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Пароль --}}
        <div class="mt-4">
            <x-input-label for="password" value="Пароль" />
            <x-text-input
                id="password"
                name="password"
                type="password"
                class="block mt-1 w-full"
                required
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Подтверждение пароля --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Подтверждение пароля" />
            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="block mt-1 w-full"
                required
            />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="ms-4">
                Зарегистрироваться
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
