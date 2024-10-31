<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorias') }}
        </h2>

    </x-slot>

    <div class="">
        <div class="flex justify-center sm:justify-end items-center mx-10 my-2">
            <a href="{{route('categorias.create')}}" class="btn-action bg-green-700"> Nueva Categoria</a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

<div class="relative">
    <table class="hidden md:table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Descripción</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                    {{$categoria->nombre}}
                </th>
                <td class="px-6 py-4">{{$categoria->descripcion}}</td>
                <td class="px-6 py-4 flex justify-center items-center space-x-2">
                    <a href="{{route('categorias.show', $categoria->id)}}" class="btn-action bg-blue-700">Ver</a>
                    <a href="{{route('categorias.edit', $categoria->id)}}" class="btn-action bg-yellow-500">Editar</a>
                    <form action="{{route('categorias.destroy', $categoria->id)}}" method="post" class="inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="3" class="px-6 py-4 text-center">No hay categorías</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Vista de tarjetas para dispositivos móviles -->
    <div class="md:hidden space-y-4">
        @forelse($categorias as $categoria)
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
            <h2 class="font-semibold text-gray-900 dark:text-white text-lg">{{$categoria->nombre}}</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">{{$categoria->descripcion}}</p>
            <div class="flex justify-around mt-4 space-x-2">
                <a href="{{route('categorias.show', $categoria->id)}}" class="btn-action bg-blue-700">Ver</a>
                <a href="{{route('categorias.edit', $categoria->id)}}" class="btn-action bg-yellow-500">Editar</a>
                <form action="{{route('categorias.destroy', $categoria->id)}}" method="post" class="inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn-action bg-red-700">Eliminar</button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 text-center">
            No hay categorías
        </div>
        @endforelse
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>