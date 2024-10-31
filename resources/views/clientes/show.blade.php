<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Cliente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Botón para Volver -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('clientes.index') }}" class="btn-action bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Volver a Clientes</a>
                    </div>

                    <!-- Información del Cliente -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Información General</h3>
                            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                            <p><strong>Email:</strong> {{ $cliente->email ?? 'N/A' }}</p>
                            <p><strong>Teléfono:</strong> {{ $cliente->telefono ?? 'N/A' }}</p>
                        </div>

                        <div class="col-span-1">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Detalles Adicionales</h3>
                            <p><strong>Dirección:</strong> {{ $cliente->direccion ?? 'N/A' }}</p>
                            <p><strong>CI/RUC:</strong> {{ $cliente->ci_ruc ?? 'N/A' }}</p>
                            <p><strong>Fecha de Cumpleaños:</strong> 
                                {{ $cliente->fecha_cumple ? \Carbon\Carbon::parse($cliente->fecha_cumple)->format('d/m/Y') : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-6 flex justify-center space-x-4">
                        <!-- Botón Editar -->
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-action bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">Editar</a>
                        
                        <!-- Botón Eliminar -->
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
