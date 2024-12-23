<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Caja') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('cajas.update', $caja->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium">Nombre de la Caja</label>
                            <input type="text" name="nombre" id="nombre" class="w-full mt-1 p-2 border dark:border-gray-600 rounded-lg" value="{{ $caja->nombre }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="saldo_inicial" class="block text-sm font-medium">Saldo Inicial</label>
                            <input type="number" name="saldo_inicial" id="saldo_inicial" class="w-full mt-1 p-2 border dark:border-gray-600 rounded-lg" value="{{ $caja->saldo_inicial }}" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Actualizar</button>
                        <a href="{{ route('cajas.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
