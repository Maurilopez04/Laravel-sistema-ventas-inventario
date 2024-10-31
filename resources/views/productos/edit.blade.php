<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Formulario para Editar Producto -->
                    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                         <!-- Código -->
                         <div class="mb-4">
                            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ $producto->codigo }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" required>
                        </div>

                        <!-- Código de Barras -->
                        <div class="mb-4">
                            <label for="codigo_de_barras" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código de Barras</label>
                            <input type="text" name="codigo_de_barras" id="codigo_de_barras" value="{{ $producto->codigo_de_barras }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
                        </div>
                    </div>
                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Producto</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">{{ $producto->descripcion }}</textarea>
                        </div>

                        <!-- Imagen Actual -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagen Actual</label>
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="mt-2 mb-2 w-32 h-32 object-cover">
                        </div>

                        <!-- Subir Nueva Imagen -->
                        <div class="mb-4">
                            <label for="imagen" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subir Nueva Imagen (opcional)</label>
                            <input type="file" name="imagen" id="imagen" class="mt-1 block w-full text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        </div>

                     <!-- Precios y Costo -->
<div class="mb-4">
    <label for="costo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Costo</label>
    <input type="number" step="0.01" name="costo" id="costo" value="{{ fmod($producto->costo, 1) ? $producto->costo : floor($producto->costo) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
    <div>
        <label for="precioMayorista" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio Mayorista</label>
        <input type="number" step="0.01" name="precioMayorista" id="precioMayorista" value="{{ fmod($producto->precioMayorista, 1) ? $producto->precioMayorista : floor($producto->precioMayorista) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
    </div>
    <div>
        <label for="precioMinorista" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio Minorista</label>
        <input type="number" step="0.01" name="precioMinorista" id="precioMinorista" value="{{ fmod($producto->precioMinorista, 1) ? $producto->precioMinorista : floor($producto->precioMinorista) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
    </div>
    <div>
        <label for="precioConInstalacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio con Instalación</label>
        <input type="number" step="0.01" name="precioConInstalacion" id="precioConInstalacion" value="{{ fmod($producto->precioConInstalacion, 1) ? $producto->precioConInstalacion : floor($producto->precioConInstalacion) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
    </div>
</div>


                    
                        <!-- Categoría y Marca -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="categoria_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                                <select name="categoria_id" id="categoria_id" class="select2 mt-1 py-2 px-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
                                <option value="" class="py-4">Ninguna</option>     
                                @foreach($categorias as $categoria)
                                        <option class="py-4" value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="marca_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca</label>
                                <select name="marca_id" id="marca_id" class="select2 mt-1 py-2 px-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300">
                                <option class="py-4" value="">Ninguna</option>    
                                @foreach($marcas as $marca)
                                        <option class="py-4" value="{{ $marca->id }}" {{ $marca->id == $producto->marca_id ? 'selected' : '' }}>{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('productos.index') }}" class="btn-action bg-gray-500 mr-2">Cancelar</a>
                            <button type="submit" class="btn-action bg-green-700">Actualizar Producto</button>
                        </div>
                    </form>
                    <script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
            width: '100%'
        });
    });
</script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
