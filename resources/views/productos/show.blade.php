<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Producto') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Encabezado del Producto -->
                    <div class="mb-6 text-center">
                        <h3 class="text-3xl font-bold mb-2">{{ $producto->nombre }}</h3>
                        <p class="text-gray-500 dark:text-gray-400">{{ $producto->descripcion }}</p>
                    </div>

                    <!-- Imagen del Producto -->
                    <div class="mb-6 flex justify-center">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" class="w-48 h-auto rounded-lg shadow-md">
                    </div>

                    <!-- Información General -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-4">
                            <p><strong>Código:</strong> {{ $producto->codigo }}</p>
                            <p><strong>Código de Barras:</strong> {{ $producto->codigo_de_barras }}</p>
                            <p><strong>Cantidad en Inventario:</strong> {{ $producto->cantidad }}</p>
                            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'N/A' }}</p>
                        <p><strong>Marca:</strong> {{ $producto->marca->nombre ?? 'N/A' }}</p>
                        </div>
                        <div class="space-y-4">
                            <p><strong>Costo:</strong> ₲ {{ number_format($producto->costo, 0) }}</p>
                            <p><strong>Precio Mayorista:</strong> ₲ {{ number_format($producto->precioMayorista, 0) }}</p>
                            <p><strong>Precio Minorista:</strong> ₲ {{ number_format($producto->precioMinorista, 0) }}</p>
                            <p><strong>Precio con Instalación:</strong> ₲ {{ number_format($producto->precioConInstalacion, 0) }}</p>
                            
                        </div>
                    </div>

                    <!-- Detalles de Categoría y Marca -->
                    <div class="grid grid-cols-2 gap-6 border-t pt-4 mt-4">
                        
                    </div>

                    <!-- Stock en Almacenes -->
                    <div class="mt-8">
                        <h4 class="text-2xl font-semibold mb-4 text-center">Stock en Almacenes</h4>
                        @if($stocks->isEmpty())
                            <p class="text-center text-gray-500 dark:text-gray-400">No hay stock en ningún almacén.</p>
                        @else
                            <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-900">
                                    <tr>
                                        <th class="py-3 px-4 border-b dark:border-gray-600 text-left">Almacén</th>
                                        <th class="py-3 px-4 border-b dark:border-gray-600 text-left">Ubicación</th>
                                        <th class="py-3 px-4 border-b dark:border-gray-600 text-left">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $stock)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                                            <td class="py-3 px-4 border-b dark:border-gray-600">{{ $stock->almacen->nombre }}</td>
                                            <td class="py-3 px-4 border-b dark:border-gray-600">{{ $stock->almacen->ubicacion }}</td>
                                            <td class="py-3 px-4 border-b dark:border-gray-600">{{ $stock->cantidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-center mt-8 space-x-6">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="px-6 py-2 bg-yellow-500 text-white rounded-lg shadow-lg hover:bg-yellow-600 transition">
                            Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-2 bg-red-700 text-white rounded-lg shadow-lg hover:bg-red-800 transition">
                                Eliminar
                            </button>
                        </form>
                        <a href="{{ route('productos.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow-lg hover:bg-gray-600 transition">
                            Volver
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


