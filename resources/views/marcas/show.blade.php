<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de marca') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <!-- Información de la marcas -->
                <div class="mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $marca->nombre }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $marca->descripcion }}</p>
                </div>

                <!-- Lista de Productos Relacionados -->
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Productos Relacionados</h3>
                
                @if($productos->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">No hay productos relacionados en esta marca.</p>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($productos as $producto)
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $producto->nombre }}</h4>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $producto->descripcion }}</p>
                                <p class="text-gray-700 dark:text-gray-300 mt-2 font-semibold">Precio: ${{ number_format($producto->precioMinorista, 0) }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Botón de Volver -->
                <div class="mt-6">
                    <a href="{{ route('marcas.index') }}" class="btn-action bg-blue-700">Volver a marcas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>