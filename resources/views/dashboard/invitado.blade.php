<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de invitado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenido, invitado') }}</h3>
                    <p class="mt-4">{{ __('Tienes acceso básico. Regístrate o solicita más permisos para ver contenido avanzado.') }}</p>
                    <ul class="mt-6 list-disc list-inside text-sm text-gray-700">
                        <li>{{ __('Navegar el contenido público') }}</li>
                        <li>{{ __('Ver mensajes de bienvenida') }}</li>
                        <li>{{ __('Solicitar un rol con más permisos') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
