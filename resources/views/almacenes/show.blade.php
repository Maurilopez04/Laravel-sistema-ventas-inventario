<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Almacén') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-2xl font-bold">{{ $almacene->nombre }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $almacene->ubicacion }}</p>
                <hr class="my-4 border-gray-200 dark:border-gray-700">

                <h4 class="text-lg font-semibold mt-6 mb-4">Movimiento de Stock de Productos</h4>

                <div class="relative">
                    <table class="hidden md:table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Producto</th>
                                <th scope="col" class="px-6 py-3">Cantidad</th>
                                <th scope="col" class="px-6 py-3">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $stock)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $stock->producto->nombre }}
                                </td>
                                <td class="px-6 py-4">{{ $stock->cantidad }}</td>
                                <td class="px-6 py-4">{{ ucfirst($stock->tipo) }}</td>
                            </tr>
                            @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="3" class="px-6 py-4 text-center">No hay movimiento de stock registrado en este almacén</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Vista de tarjetas para dispositivos móviles -->
                    <div class="md:hidden space-y-4">
                        @forelse($stocks as $stock)
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                            <h2 class="font-semibold text-gray-900 dark:text-white text-lg">
                                {{ $stock->producto->nombre }}
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400 mt-1">Cantidad: {{ $stock->cantidad }}</p>
                            <p class="text-gray-500 dark:text-gray-400">Tipo: {{ ucfirst($stock->tipo) }}</p>
                        </div>
                        @empty
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 text-center">
                            No hay movimiento de stock registrado en este almacén
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
