<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="flex justify-center sm:justify-end items-center mx-10 my-2">
            <a href="{{ route('productos.create') }}" class="btn-action bg-green-700">Nuevo Producto</a>
        </div>

        <div class="mx-auto sm:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Barra de búsqueda y selector de registros por página -->
                    <div class="flex justify-between mb-4">
                        <!-- Formulario de búsqueda -->
                        <form action="{{ route('productos.index') }}" method="GET" class="flex space-x-2">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Buscar Nombre/Código" 
                                value="{{ request('search') }}" 
                                class="px-4 py-2 border rounded-md focus:outline-none focus:ring text-gray-600"
                            />
                            <button type="submit" class="btn-action bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Buscar
                            </button>
                        </form>

                        <!-- Selector de registros por página -->
                        <form action="{{ route('productos.index') }}" method="GET">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select 
                                name="perPage" 
                                onchange="this.form.submit()" 
                                class="ps-3 pe-8 py-2 border rounded-md focus:outline-none focus:ring text-gray-600"
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
                                <th scope="col" class="px-2 border border-gray-400 py-3">Código</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Nombre</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Categoría</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Marca</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Precio Minorista</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Cantidad</th>
                                <th scope="col" class="px-2 border border-gray-400 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $producto)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-2 border border-gray-400 py-4">{{ $producto->codigo }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $producto->nombre }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $producto->categoria->nombre ?? 'N/A' }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $producto->marca->nombre ?? 'N/A' }}</td>
                                    <td class="px-2 border border-gray-400 py-4">₲ {{ number_format($producto->precioMinorista, 0) }}</td>
                                    <td class="px-2 border border-gray-400 py-4">{{ $producto->cantidad }}</td>
                                    <td class="px-2 border border-gray-400 py-4 flex justify-center items-center space-x-2">
                                        <a href="{{ route('productos.show', $producto->id) }}" class="btn-action bg-blue-700">Ver</a>
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn-action bg-yellow-500">Editar</a>
                                        <?php  /*  <!--form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                        </form--> */?>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center">No hay productos disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Vista de tarjetas para dispositivos móviles -->
                    <div class="md:hidden space-y-4">
                        @forelse($productos as $producto)
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                                <h2 class="font-semibold text-gray-900 dark:text-white text-lg">{{ $producto->nombre }}</h2>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Código: {{ $producto->codigo }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Categoría: {{ $producto->categoria->nombre ?? 'N/A' }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Marca: {{ $producto->marca->nombre ?? 'N/A' }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Precio Minorista: ₲ {{ number_format($producto->precioMinorista, 0) }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Cantidad: {{ $producto->cantidad }}</p>
                                <div class="flex justify-around mt-4 space-x-2">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn-action bg-blue-700">Ver</a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn-action bg-yellow-500">Editar</a>
                                 <?php  /* <!--form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                    </form-->
                                    */?>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 text-center">
                                No hay productos disponibles
                            </div>
                        @endforelse
                    </div>

                </div>

                <!-- Controles de paginación -->
                <div class="mt-4">
                    {{ $productos->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

</x-app-layout>
