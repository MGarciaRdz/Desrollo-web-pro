<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenido, usuario') }}</h3>
                    <p class="mt-4">{{ __('Accede a tus datos personales y mantén activada tu protección de dos factores.') }}</p>
                    <ul class="mt-6 list-disc list-inside text-sm text-gray-700">
                        <li>{{ __('Ver tu perfil y actualizar información') }}</li>
                        <li>{{ __('Administrar tu autenticación de dos factores') }}</li>
                        <li>{{ __('Acceso seguro a contenido protegido') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
