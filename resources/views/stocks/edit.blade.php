<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Movimiento de Stock') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Producto -->
                    <div class="mb-4">
                        <label for="producto_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Producto</label>
                        <select name="producto_id" id="producto_id" class="form-select mt-1 block w-full">
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ $stock->producto_id == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cantidad -->
                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-input mt-1 block w-full" value="{{ $stock->cantidad }}" required>
                    </div>

                    <!-- Tipo de Movimiento -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Movimiento</label>
                        <select name="tipo" id="tipo" class="form-select mt-1 block w-full">
                            <option value="entrada" {{ $stock->tipo == 'entrada' ? 'selected' : '' }}>Entrada</option>
                            <option value="salida" {{ $stock->tipo == 'salida' ? 'selected' : '' }}>Salida</option>
                        </select>
                    </div>

                    <!-- Almacén -->
                    <div class="mb-4">
                        <label for="almacen_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Almacén</label>
                        <select name="almacen
