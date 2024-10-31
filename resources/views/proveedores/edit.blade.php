<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Proveedor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulario de edición de proveedor -->
                    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required
                                   class="border border-gray-300 rounded-md p-2 w-full @error('nombre') border-red-500 @enderror">
                            @error('nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RUC -->
                        <div class="mb-4">
                            <label for="ruc" class="block text-gray-700 dark:text-gray-300">RUC</label>
                            <input type="text" name="ruc" id="ruc" value="{{ old('ruc', $proveedor->ruc) }}" required
                                   class="border border-gray-300 rounded-md p-2 w-full @error('ruc') border-red-500 @enderror">
                            @error('ruc')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-4">
                            <label for="telefono" class="block text-gray-700 dark:text-gray-300">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}"
                                   class="border border-gray-300 rounded-md p-2 w-full @error('telefono') border-red-500 @enderror">
                            @error('telefono')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $proveedor->email) }}"
                                   class="border border-gray-300 rounded-md p-2 w-full @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="block text-gray-700 dark:text-gray-300">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $proveedor->direccion) }}"
                                   class="border border-gray-300 rounded-md p-2 w-full @error('direccion') border-red-500 @enderror">
                            @error('direccion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex justify-end">
                            <a href="{{ route('proveedores.index') }}" class="btn-action bg-gray-700 mr-2">Cancelar</a>
                            <button type="submit" class="btn-action bg-blue-700">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
