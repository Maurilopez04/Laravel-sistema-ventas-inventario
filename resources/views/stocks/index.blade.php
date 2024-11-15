<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Movimientos de Stock') }}
        </h2>
    </x-slot>
    <!-- Error -->
    @if(session('errorr'))
        <div class="bg-red-500 text-white p-4 rounded-md shadow-lg flex items-center"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.366-.446 1.075-.546 1.541-.216C10.63 3.279 11 3.85 11 4.5v6l3.707 3.707a1 1 0 01-1.414 1.414l-4-4a1 1 0 01-.293-.707V4.5c0-.648.37-1.219.902-1.415a1.007 1.007 0 01.648 0zM7 17a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('errorr') }}</span>
        </div>
    @endif
    <div class="">
        <div class="flex justify-center sm:justify-end items-center mx-10 my-2">
            <a href="{{ route('stocks.create') }}" class="btn-action bg-green-700"> Nuevo movimiento</a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="relative">
                        <table class="hidden md:table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Producto</th>
                                    <th scope="col" class="px-6 py-3">Cantidad</th>
                                    <th scope="col" class="px-6 py-3">Tipo</th>
                                    <th scope="col" class="px-6 py-3">Almacén</th>
                                    <th scope="col" class="px-6 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stocks as $stock)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $stock->producto->nombre }}
                                    </th>
                                    <td class="px-6 py-4">{{ $stock->cantidad }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($stock->tipo) }}</td>
                                    <td class="px-6 py-4">{{ $stock->almacen->nombre }}</td>
                                    <td class="px-6 py-4 flex justify-center items-center space-x-2">
                                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="5" class="px-6 py-4 text-center">No hay movimientos de stock registrados</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Vista de tarjetas para dispositivos móviles -->
                        <div class="md:hidden space-y-4">
                            @forelse($stocks as $stock)
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                                <h2 class="font-semibold text-gray-900 dark:text-white text-lg">{{ $stock->producto->nombre }}</h2>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Cantidad: {{ $stock->cantidad }}</p>
                                <p class="text-gray-500 dark:text-gray-400">Tipo: {{ ucfirst($stock->tipo) }}</p>
                                <p class="text-gray-500 dark:text-gray-400">Almacén: {{ $stock->almacen->nombre }}</p>
                                <div class="flex justify-around mt-4 space-x-2">
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 text-center">
                                No hay movimientos de stock registrados
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
