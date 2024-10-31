<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar marca') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('marcas.update', $marca->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nombre de la marca -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la marca</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $marca->nombre) }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nombre')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción de la marca -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion', $marca->descripcion) }}</textarea>
                        @error('descripcion')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-end">
                        <a href="{{ route('marcas.index') }}" class="btn-action bg-gray-500 mr-4">Cancelar</a>
                        <button type="submit" class="btn-action bg-green-700">Actualizar marca</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>