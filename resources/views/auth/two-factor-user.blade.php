<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Introduce el código de 6 dígitos de Google Authenticator para continuar.') }}
    </div>

    <form method="POST" action="{{ route('two-factor.verify') }}">
        @csrf

        <div>
            <x-input-label for="one_time_password" :value="__('Código de autenticación')" />
            <x-text-input id="one_time_password" name="one_time_password" type="text" inputmode="numeric" pattern="\d{6}" class="mt-1 block w-full" required autofocus autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('one_time_password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verificar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
