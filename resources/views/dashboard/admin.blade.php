<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenido, administrador') }}</h3>
                    <p class="mt-4">{{ __('Aquí puedes gestionar usuarios, revisar la seguridad y acceder a funcionalidades avanzadas.') }}</p>
                    <ul class="mt-6 list-disc list-inside text-sm text-gray-700">
                        <li>{{ __('Revisión de actividad de seguridad') }}</li>
                        <li>{{ __('Gestión de permisos y roles') }}</li>
                        <li>{{ __('Acceso completo a configuraciones administrativas') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
