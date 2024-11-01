<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle del Movimiento de Stock') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                
                <!-- Detalles del Movimiento de Stock -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Producto</h3>
                    <p class="text-gray-900 dark:text-white">{{ $stock->producto->nombre }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Cantidad</h3>
                    <p class="text-gray-900 dark:text-white">{{ $stock->cantidad }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Tipo de Movimiento</h3>
                    <p class="text-gray-900 dark:text-white">{{ ucfirst($stock->tipo) }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Almacén</h3>
                    <p class="text-gray-900 dark:text-white">{{ $stock->almacen->nombre }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Fecha de Registro</h3>
                    <p class="text-gray-900 dark:text-white">{{ $stock->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <!-- Botones de Acción -->
                <div class="flex justify-end space-x-2 mt-4">
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn-action bg-yellow-500">Editar</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                    </form>
                    <a href="{{ route('stocks.index') }}" class="btn-action bg-gray-700">Volver</a>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
