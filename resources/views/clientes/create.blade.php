<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Cliente') }}
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

                    <!-- Formulario de Creación -->
                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf

                        <!-- Campo de Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Teléfono -->
                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200" value="{{ old('telefono') }}">
                            @error('telefono')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200" value="{{ old('direccion') }}">
                            @error('direccion')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de CI/RUC -->
                        <div class="mb-4">
                            <label for="ci_ruc" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CI/RUC</label>
                            <input type="text" name="ci_ruc" id="ci_ruc" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200" value="{{ old('ci_ruc') }}">
                            @error('ci_ruc')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Fecha de Cumpleaños -->
                        <div class="mb-4">
                            <label for="fecha_cumple" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Cumpleaños</label>
                            <input type="date" name="fecha_cumple" id="fecha_cumple" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200" value="{{ old('fecha_cumple') }}">
                            @error('fecha_cumple')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botón Guardar -->
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="btn-action bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">Guardar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
