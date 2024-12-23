<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Caja') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">{{ $caja->nombre }}</h3>
                    <p><strong>Saldo Inicial:</strong> ₲ {{ number_format($caja->saldo_inicial, 0) }}</p>
                    <p><strong>Fecha de Creación:</strong> {{ $caja->created_at->format('d/m/Y') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('cajas.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
