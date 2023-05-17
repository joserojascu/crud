<?php

use App\Http\Controllers\Auth\ClientesController;
use App\Http\Controllers\Auth\FactulineasController;
use App\Http\Controllers\Auth\FormulasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProductosController;
use App\Models\Clientes;
use App\Models\Factulineas;
use App\Models\Productos;
use Dotenv\Exception\ValidationException;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/', 'dashboard')->middleware('auth');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->middleware('auth');
Route::view('productos', 'productos');


Route::post('login',[LoginController::class, 'login']);
Route::post('logout',[LoginController::class, 'logout']);
Route::get('/dashboard1/{id}', [ClientesController::class, 'show'])->name('clientes.show');
Route::get('dashboard', [ClientesController::class, 'index'])->name('clientes.index');
Route::post('dashboard', [ClientesController::class, 'buscar'])->name('consulta');
Route::post('dashboard/agregar', [FormulasController::class, 'store'])->name('productos.agregar');
Route::get('dashboard/facturar', [FactulineasController::class, 'index'])->name('factulineas.index');
Route::post('dashboard/facturar', [FactulineasController::class, 'store'])->name('factulineas.agregar');
Route::delete('dashboard/{id}/{id_formula}/{id_cliente}', [FactulineasController::class, 'destroy'])->name('productos.destroy');
Route::get('dashboard/edit/{id}', [FactulineasController::class, 'edit'])->name('factulineas.edit');
Route::put('productos/{id}', [FactulineasController::class, 'update'])->name('factulineas.update');

