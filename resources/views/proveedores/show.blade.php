<!-- resources/views/proveedores/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Proveedor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Contenedor responsive para los detalles del proveedor -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Nombre:</h3>
                            <p class="text-gray-900 dark:text-gray-100">{{ $proveedor->nombre }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">RUC:</h3>
                            <p class="text-gray-900 dark:text-gray-100">{{ $proveedor->ruc }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Teléfono:</h3>
                            <p class="text-gray-900 dark:text-gray-100">{{ $proveedor->telefono ?? 'No proporcionado' }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Email:</h3>
                            <p class="text-gray-900 dark:text-gray-100">{{ $proveedor->email ?? 'No proporcionado' }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Dirección:</h3>
                            <p class="text-gray-900 dark:text-gray-100">{{ $proveedor->direccion ?? 'No proporcionado' }}</p>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-6 flex justify-end space-x-2">
                        <a href="{{ route('proveedores.index') }}" class="btn-action bg-gray-700">Volver</a>
                        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn-action bg-blue-700">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
