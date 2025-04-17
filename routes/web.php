<?php

use App\Http\Controllers\Agendamientos\AgendamientoDescargaController;
use App\Http\Controllers\Agendamientos\FormatoDescarga;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Operaciones\OperacionController;
use App\Http\Controllers\Seguridad\PermissionController;
use App\Http\Controllers\Seguridad\RoleController;
use App\Http\Controllers\Usuarios\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('bienvenido'); // Se le asigna un nombre a la ruta raiz de la app

Route::prefix('agendamiento/formato-descarga')->name('agendamiento.formato-descarga.')->group(function () {
    // Muestra el formulario público de formato-descarga
    Route::get('/', [FormatoDescarga::class, 'index'])->name('index');

    // Procesa el envío del formulario de formato-descarga
    Route::post('/', [FormatoDescarga::class, 'enviar'])->name('enviar');
}); //Rutas para el formato de agendamiento de descarga, tanto para mostrar el formato como para enviarlo a la API del Microservicio.

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

 // Rutas para Permisos
Route::middleware(['permission:Administrar Permisos'])->prefix('seguridad/permisos')->name('seguridad.permisos.')->group(function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::get('/crear', [PermissionController::class, 'create'])->name('create');
    Route::post('/', [PermissionController::class, 'store'])->name('store');
    Route::get('/{permission}/editar', [PermissionController::class, 'edit'])->name('edit');
    Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
    Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
});

// Rutas para Roles
Route::middleware(['permission:Administrar Roles'])->prefix('seguridad/roles')->name('seguridad.roles.')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/crear', [RoleController::class, 'create'])->name('create');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/{role}/editar', [RoleController::class, 'edit'])->name('edit');
    Route::put('/{role}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
});
// Rutas para Usuarios
Route::middleware(['permission:Administrar Usuarios'])->prefix('usuarios')->name('usuarios.')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('index');
    Route::get('/crear', [UsuarioController::class, 'create'])->name('create');
    Route::post('/', [UsuarioController::class, 'store'])->name('store');
    Route::get('/{usuario}/editar', [UsuarioController::class, 'edit'])->name('edit');
    Route::put('/{usuario}', [UsuarioController::class, 'update'])->name('update');
    Route::delete('/{usuario}', [UsuarioController::class, 'destroy'])->name('destroy');
});
//Rutas para operaciones
Route::middleware(['permission:Administrar Operaciones'])->prefix('operaciones')->name('operaciones.')->group(function () {
    Route::get('/', [OperacionController::class, 'index'])->name('index');
    Route::get('/crear', [OperacionController::class, 'create'])->name('create');
    Route::post('/', [OperacionController::class, 'store'])->name('store');
    Route::get('/{operacion}/editar', [OperacionController::class, 'edit'])->name('edit');
    Route::put('/{operacion}', [OperacionController::class, 'update'])->name('update');
    Route::delete('/{operacion}', [OperacionController::class, 'destroy'])->name('destroy');
});
// Rutas para Agendamientos (Solicitudes)
Route::middleware(['permission:Administrar Agendamientos'])->prefix('agendamientos')
->name('solicitudes.')->group(function () {

    Route::get('/gestion', [AgendamientoDescargaController::class, 'index'])->name('gestion');
    // Grupo para todo lo relacionado a solicitudes PENDIENTES
    Route::prefix('pendientes')->group(function () {
    // Listar pendientes
    Route::get('/', [AgendamientoDescargaController::class, 'pendientes'])->name('pendientes');
    // Editar (formulario)
    Route::put('/{id}', [AgendamientoDescargaController::class, 'update'])->name('update');
        });
});
