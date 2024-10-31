<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Proveedores') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="flex justify-between items-center mx-10 my-2">
            <a href="{{ route('proveedores.create') }}" class="btn-action bg-green-700">Nuevo Proveedor</a>
            <!-- Buscador -->
            <form action="{{ route('proveedores.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar..." 
                       class="border border-gray-300 rounded-md p-2">
                <select name="perPage" onchange="this.form.submit()" class="border border-gray-300 rounded-md p-2 pe-8 ps-4">
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                </select>
                <button type="submit" class="btn-action bg-blue-700">Buscar</button>
            </form>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Tabla de proveedores -->
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">RUC</th>
                                <th class="px-6 py-3">Teléfono</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proveedores as $proveedor)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $proveedor->nombre }}</td>
                                    <td class="px-6 py-4">{{ $proveedor->ruc }}</td>
                                    <td class="px-6 py-4">{{ $proveedor->telefono }}</td>
                                    <td class="px-6 py-4">{{ $proveedor->email }}</td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn-action bg-blue-700">Ver</a>
                                        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn-action bg-yellow-500">Editar</a>
                                        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">No hay proveedores disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Controles de paginación -->
                    <div class="mt-4">
                        {{ $proveedores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
