<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\CitasController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get(
    '/getDataEventos',
    [EventosController::class, 'readAll']
)->middleware(['auth']);

Route::get(
    '/getEvento/{id}',
    [EventosController::class, 'readOne']
)->middleware(['auth']);

Route::get(
    '/getDayEvent/{id}/{day}',
    [ConfiguracionesController::class, 'readDay']
)->middleware(['auth']);

Route::post(
    '/postReserva',
    [CitasController::class, 'reservar']
)->middleware(['auth']);

require __DIR__ . '/auth.php';
