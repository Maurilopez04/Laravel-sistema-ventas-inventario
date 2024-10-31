<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-4">
          <div class="flex justify-end mb-4">
            <a href="{{ route('clientes.create') }}" class="btn-action bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Agregar Cliente</a>
          </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Barra de búsqueda y selector de registros por página -->
                    <div class="flex justify-between mb-4">
                        <!-- Formulario de búsqueda -->
                        <form action="{{ route('clientes.index') }}" method="GET" class="flex space-x-2">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Buscar Nombre/Ruc" 
                                value="{{ request('search') }}" 
                                class="px-4 py-2 border rounded-md focus:outline-none focus:ring text-gray-600"
                            />
                            <button type="submit" class="btn-action bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Buscar
                            </button>
                        </form>

                        <!-- Selector de registros por página -->
                        <form action="{{ route('clientes.index') }}" method="GET">
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

                    <!-- Tabla de Clientes -->
                    <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md">
                        <thead>
                            <tr class="bg-gray-900">
                                <th class="py-2 px-2 border dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Nombre</th>
                                <th class="py-2 px-2 border dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Email</th>
                                <th class="py-2 px-2 border dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Teléfono</th>
                                <th class="py-2 px-2 border dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Dirección</th>
                                <th class="py-2 px-2 border dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">CI/RUC</th>
                                <th class="py-2 px-2 border dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Fecha de Cumpleaños</th>
                                <th class="py-2 px-2 border dark:border-gray-600 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td class="py-3 px-2 border dark:border-gray-600">{{ $cliente->nombre }}</td>
                                    <td class="py-3 px-2 border dark:border-gray-600">{{ $cliente->email ?? 'N/A' }}</td>
                                    <td class="py-3 px-2 border dark:border-gray-600">{{ $cliente->telefono ?? 'N/A' }}</td>
                                    <td class="py-3 px-2 border dark:border-gray-600">{{ $cliente->direccion ?? 'N/A' }}</td>
                                    <td class="py-3 px-2 border dark:border-gray-600">{{ $cliente->ci_ruc ?? 'N/A' }}</td>
                                    <td class="py-3 px-2 border dark:border-gray-600">{{ $cliente->fecha_cumple ? \Carbon\Carbon::parse($cliente->fecha_cumple)->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="py-3 h-full px-2 border dark:border-gray-600 text-center flex justify-center space-x-2">
                                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn-action bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Ver</a>
                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-action bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md">Editar</a>
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($clientes->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400 mt-4">No hay clientes registrados.</p>
                    @endif
                </div>

                <!-- Paginación -->
                <div class="mb-4 mx-20">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
