<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>

        <style>
    .btn-action {
        color: #fff;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
        text-align: center;
        display: inline-block;
    }
    .btn-action:hover {
        opacity: 0.9;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div x-data="{ sidebarOpen: false, reportesOpen: false, adminOpen: true }" class="flex h-screen">
        
        <!-- Sidebar para dispositivos grandes -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-md z-20 hidden md:block">
            <div class="h-full flex flex-col">
                <div class="p-6 text-center font-bold text-gray-800 dark:text-gray-100">
                    <h1 class="text-2xl">EmpresaNombre</h1>
                </div>
                <nav class="mt-2 flex-1">
                <ul class="text-gray-600 dark:text-gray-300">
                    <!-- Enlace principal -->
                    <li><a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Inicio</a></li>

                    <!-- Subgrupo: Administración -->
                    <li @click="adminOpen = !adminOpen" class="cursor-pointer py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 flex justify-between">
                        <span>Administración</span>
                        <svg :class="{ 'transform rotate-180': adminOpen }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </li>
                    <ul x-show="adminOpen" class="pl-6 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('marcas.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Marcas</a></li>
                        <li><a href="{{ route('categorias.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Categorías</a></li>
                        <li><a href="{{ route('productos.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Productos</a></li>
                        <li><a href="{{ route('clientes.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Clientes</a></li>
                        <li><a href="{{ route('proveedores.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Proveedores</a></li>
                        <li><a href="{{ route('almacenes.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Almacenes</a></li>
                        <li><a href="{{ route('cajas.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Cajas</a></li>
                    </ul>

                    <li><a href="{{ route('stocks.index') }}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Stock</a></li>

                    <!-- Subgrupo: Reportes -->
                    <li @click="reportesOpen = !reportesOpen" class="cursor-pointer py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 flex justify-between">
                        <span>Reportes</span>
                        <svg :class="{ 'transform rotate-180': reportesOpen }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </li>
                    <ul x-show="reportesOpen" class="pl-6 mt-1 space-y-1" x-cloak>
                        <li><a href="#" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Ventas</a></li>
                        <li><a href="#" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Compras</a></li>
                        <li><a href="#" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Inventario</a></li>
                    </ul>
                </ul>
                </nav>
            </div>
        </aside>

        <!-- Sidebar para dispositivos móviles -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden"></div>
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-md transform transition-transform duration-300 z-40 md:hidden">
            <div class="h-full flex flex-col">
                <div class="p-6 text-center font-bold text-gray-800 dark:text-gray-100">
                    <h1 class="text-2xl">EmpresaLogo</h1>
                </div>
                <nav class="mt-4 flex-1">
                    <ul class="text-gray-600 dark:text-gray-300">
                    <li><a href="{{route('dashboard')}}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Inicio</a></li>
                        <li><a href="{{route('marcas.index')}}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Marcas</a></li>
                        <li><a href="{{route('categorias.index')}}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Categorias</a></li>
                        <li><a href="{{route('productos.index')}}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Productos</a></li>
                        <li><a href="{{route('clientes.index')}}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Clientes</a></li>
                        <li><a href="{{route('proveedores.index')}}" class="block py-2.5 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Proveedores</a></li>
                        <!-- Más enlaces aquí -->
                    </ul>
                    
                </nav>
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
            </div>
        </aside>

        <!-- Contenedor Principal -->
        <div class="flex-1 flex flex-col md:ml-64">
            
            <!-- Header -->
            <header class="bg-white dark:bg-gray-700 shadow flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <!-- Botón de menú para dispositivos móviles -->
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 ml-2">@if (isset($header))  {{ $header }} @endif</h2>
                </div>
                <livewire:layout.navigation />
            </header>

            <!-- Contenido de la Página -->
<!-- Toast Notifications -->
<div id="toast-container" class="fixed top-5 right-5 space-y-4 z-50">
    <!-- Éxito -->
    @if(session('success'))
        <div class="toast bg-green-500 text-white p-4 rounded-md shadow-lg flex items-center" 
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 7000)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Error -->
    @if(session('error'))
        <div class="toast bg-red-500 text-white p-4 rounded-md shadow-lg flex items-center" 
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 7000)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.366-.446 1.075-.546 1.541-.216C10.63 3.279 11 3.85 11 4.5v6l3.707 3.707a1 1 0 01-1.414 1.414l-4-4a1 1 0 01-.293-.707V4.5c0-.648.37-1.219.902-1.415a1.007 1.007 0 01.648 0zM7 17a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif
</div>


            <main class="flex-1 bg-gray-100 dark:bg-gray-900 m-1">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script>
$(document).ready(function() {
   $('.select2').select2();
});
                    </script>
</body>

</html>
