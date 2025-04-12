<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

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

// Rutas de autenticación
Route::get('/', [DashboardController::class, 'index'])->name('welcome');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas (deberían tener middleware de autenticación en producción)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas temporales para las diferentes secciones
Route::get('/pos', function () {
    return view('coming_soon', ['module' => 'Punto de Venta']);
})->name('pos');

Route::get('/citas', function () {
    return view('coming_soon', ['module' => 'Control de Citas']);
})->name('citas');

Route::get('/servicios', function () {
    return view('coming_soon', ['module' => 'Servicios Especializados']);
})->name('servicios');

Route::get('/medicos', function () {
    return view('coming_soon', ['module' => 'Médicos']);
})->name('medicos');
