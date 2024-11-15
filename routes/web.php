<?php

use App\Http\Controllers\AlmacenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\StockController;
use App\Models\Producto;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('categorias', CategoriaController::class)
->middleware(['auth']);

Route::resource('marcas', MarcaController::class)
->middleware(['auth']);

Route::resource('productos', ProductoController::class)
->middleware(['auth']);

Route::resource('clientes', ClienteController::class)
->middleware(['auth']);

Route::resource('proveedores', ProveedorController::class)
->middleware(['auth']);

Route::resource('almacenes', AlmacenController::class)
->middleware(['auth']);

Route::resource('stocks', StockController::class)
->middleware(['auth'])
->only(['index', 'create', 'store', 'destroy']);

require __DIR__.'/auth.php';
