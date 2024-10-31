<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Producto') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Detalles del Producto -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold mb-2">{{ $producto->nombre }}</h3>
                        <p class="text-gray-500 dark:text-gray-400">{{ $producto->descripcion }}</p>
                    </div>
                    
                    <!-- Imagen del Producto -->
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" class="w-full h-auto rounded-lg">
                    </div>

                    <!-- Información General -->
                    <div class="space-y-4">
                        <p><strong>Código:</strong> {{ $producto->codigo }}</p>
                        <p><strong>Código de Barras:</strong> {{ $producto->codigo_de_barras }}</p>
                        <p><strong>Costo:</strong> ₲ {{ number_format($producto->costo, 0) }}</p>
                        <p><strong>Precio Mayorista:</strong> ₲ {{ number_format($producto->precioMayorista, 0) }}</p>
                        <p><strong>Precio Minorista:</strong> ₲ {{ number_format($producto->precioMinorista, 0) }}</p>
                        <p><strong>Precio con Instalación:</strong> ₲ {{ number_format($producto->precioConInstalacion, 0) }}</p>
                        <p><strong>Cantidad en Inventario:</strong> {{ $producto->cantidad }}</p>
                    </div>

                    <!-- Detalles de Categoría y Marca -->
                    <div class="mt-6 space-y-4">
                        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'N/A' }}</p>
                        <p><strong>Marca:</strong> {{ $producto->marca->nombre ?? 'N/A' }}</p>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-start mt-6 space-x-4">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn-action bg-yellow-500">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                        </form>
                        <a href="{{ route('productos.index') }}" class="btn-action bg-gray-500">Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
