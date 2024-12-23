<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cajas Registradas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('cajas.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Nueva Caja</a>
                    </div>
                    <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border dark:border-gray-600">#</th>
                                <th class="py-2 px-4 border dark:border-gray-600">Nombre</th>
                                <th class="py-2 px-4 border dark:border-gray-600">Saldo Inicial</th>
                                <th class="py-2 px-4 border dark:border-gray-600">Saldo Actual</th>
                                <th class="py-2 px-4 border dark:border-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cajas as $caja)
                                <tr>
                                    <td class="py-2 px-4 border dark:border-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4 border dark:border-gray-600">{{ $caja->nombre }}</td>
                                    <td class="py-2 px-4 border dark:border-gray-600">₲ {{ number_format($caja->saldo_inicial, 0) }}</td>
                                    <td class="py-2 px-4 border dark:border-gray-600">₲ {{ number_format($caja->saldo_actual, 0) }}</td>
                                    <td class="py-2 px-4 border dark:border-gray-600">
                                        <a href="{{ route('cajas.show', $caja->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">Ver</a>
                                        <a href="{{ route('cajas.edit', $caja->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">Editar</a>
                                        <form action="{{ route('cajas.destroy', $caja->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg shadow hover:bg-red-700" onclick="return confirm('¿Estás seguro de eliminar esta caja?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-2 px-4 text-center">No hay cajas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
