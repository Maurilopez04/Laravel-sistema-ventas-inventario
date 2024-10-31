<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stock') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="flex justify-center sm:justify-end items-center mx-10 my-2">
            <a href="{{ route('stock.create') }}" class="btn-action bg-green-700">Nuevo Stock</a>
        </div>

        <div class="mx-auto sm:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Barra de búsqueda y filtros -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                        <!-- Formulario de búsqueda -->
                        <form action="{{ route('stock.index') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Buscar Producto/ID de Stock" 
                                value="{{ request('search') }}" 
                                class="px-4 py-2 border rounded-md focus:outline-none focus:ring text-gray-600"
                            />
                            <select name="category" class="px-4 py-2 border rounded-md focus:outline-none focus:ring text-gray-600">
                                <option value="">Todas las Categorías</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ request('category') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="warehouse" class="px-4 py-2 border rounded-md focus:outline-none focus:ring text-gray-600">
                                <option value="">Todos los Almacenes</option>
                                @foreach($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}" {{ request('warehouse') == $almacen->id ? 'selected' : '' }}>
                                        {{ $almacen->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-action bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Buscar
                            </button>
                        </form>

                        <!-- Selector de registros por página -->
                        <form action="{{ route('stock.index') }}" method="GET">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select 
                                name="perPage" 
                                onchange="this.form.submit()" 
                                class="px-3 py-2 border rounded-md focus:outline-none focus:ring text-gray-600 mt-2 md:mt-0"
                            >
                                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>

                    <!-- Tabla para pantallas grandes -->
                    <table class="hidden md:table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-2 border border-gray-400 py-3">ID de Stock</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Producto</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Categoría</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Almacén</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Cantidad</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Última Actualización</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $stock)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-2 border border-gray-400 py-4">{{ $stock->id }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $stock->producto->nombre }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $stock->producto->categoria->nombre ?? 'N/A' }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $stock->almacen->nombre }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $stock->cantidad }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $stock->updated_at->format('d-m-Y') }}</td>
                                    <td class="px-2 border border-gray-400 py-4 flex justify-center items-center space-x-2">
                                        <a href="{{ route('stock.show', $stock->id) }}" class="btn-action bg-blue-700">Ver</a>
                                        <a href="{{ route('stock.edit', $stock->id) }}" class="btn-action bg-yellow-500">Editar</a>
                                        <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center">No hay registros de stock disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Vista de tarjetas para dispositivos móviles -->
                    <div class="md:hidden space-y-4">
                        @forelse($stocks as $stock)
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                                <h2 class="font-semibold text-gray-900 dark:text-white text-lg">{{ $stock->producto->nombre }}</h2>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">ID de Stock: {{ $stock->id }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Categoría: {{ $stock->producto->categoria->nombre ?? 'N/A' }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Almacén: {{ $stock->almacen->nombre }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Cantidad: {{ $stock->cantidad }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Última Actualización: {{ $stock->updated_at->format('d-m-Y') }}</p>
                                <div class="flex justify-around mt-4 space-x-2">
                                    <a href="{{ route('stock.show', $stock->id) }}" class="btn-action bg-blue-700">Ver</a>
                                    <a href="{{ route('stock.edit', $stock->id) }}" class="btn-action bg-yellow-500">Editar</a>
                                    <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 text-center">
                                No hay registros de stock disponibles
                            </div>
                        @endforelse
                    </div>

                </div>

                <!-- Controles de paginación -->
                <div class="mt-4">
                    {{ $stocks->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
</x-app-layout>
