<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Создать приглашение</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('invite.create.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label for="role" class="block font-medium mb-1">Роль</label>
                <select name="role" id="role" required class="w-full border px-3 py-2 rounded">
                    @foreach ($roles as $role)
                        <option value="{{ strtolower($role) }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Создать приглашение
            </button>
        </form>
    </div>
</x-app-layout>
