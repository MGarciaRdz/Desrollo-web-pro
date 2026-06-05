<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Autenticación de dos factores') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Activa Google Authenticator para proteger tu acceso con un segundo factor.') }}
        </p>
    </header>

    @if (session('status'))
        <div class="mt-4 rounded-md bg-green-50 p-4">
            <div class="text-sm text-green-700">
                {{ session('status') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mt-4 rounded-md bg-red-50 p-4">
            <div class="text-sm text-red-700">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @php
        $user = auth()->user();
        $google2fa = app('pragmarx.google2fa');
    @endphp

    <div class="mt-6">
        <p class="text-sm text-gray-700">
            {{ __('Estado:') }}
            <span class="font-semibold">
                {{ $user->two_factor_confirmed_at ? 'Activado' : 'Desactivado' }}
            </span>
        </p>
    </div>

    @if (! $user->two_factor_secret)
        <div class="mt-6">
            <p class="text-sm text-gray-600">
                {{ __('Genera tu código QR para Google Authenticator. Después confirma el código de 6 dígitos.') }}
            </p>

            <form method="POST" action="{{ route('profile.two-factor.generate') }}" class="mt-4">
                @csrf
                <x-primary-button>{{ __('Generar código') }}</x-primary-button>
            </form>
        </div>
    @elseif (! $user->two_factor_confirmed_at)
        <div class="mt-6 space-y-4">
            <div>
                <p class="text-sm text-gray-600">
                    {{ __('Escanea este código QR en tu aplicación Google Authenticator y luego confirma el código de 6 dígitos.') }}
                </p>
            </div>

            <div class="mt-4">
                <img src="{!! $google2fa->getQRCodeInline(config('app.name'), $user->email, $user->two_factor_secret) !!}" alt="QR Code" />
            </div>

            <div class="rounded-md bg-gray-50 p-4">
                <p class="text-sm text-gray-700">{{ __('Si no puedes escanear el QR, ingresa manualmente este código:') }}</p>
                <p class="mt-2 font-mono text-sm text-gray-900">{{ $user->two_factor_secret }}</p>
            </div>

            <form method="POST" action="{{ route('profile.two-factor.confirm') }}" class="mt-4 space-y-4">
                @csrf

                <div>
                    <x-input-label for="one_time_password" :value="__('Código de 6 dígitos')" />
                    <x-text-input id="one_time_password" name="one_time_password" type="text" inputmode="numeric" pattern="\d{6}" class="mt-1 block w-full" required autofocus autocomplete="one-time-code" />
                    <x-input-error class="mt-2" :messages="$errors->get('one_time_password')" />
                </div>

                <x-primary-button>{{ __('Confirmar código') }}</x-primary-button>
            </form>
        </div>
    @else
        <div class="mt-6 rounded-md bg-green-50 p-4">
            <p class="text-sm text-green-700">
                {{ __('La autenticación de dos factores está activada. Ahora, cada vez que inicies sesión, deberás confirmar tu acceso con el código de Google Authenticator.') }}
            </p>
        </div>
    @endif
</section>
