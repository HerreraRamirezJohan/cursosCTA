<?php

use App\Http\Controllers\CursosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* Obtenemos el metodo que creamos para actualizar el perfil del usuario */
use App\Http\Controllers\HomeController;


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

Route::get('/', [CursosController::class,'index'])->name('index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/inicio', [CursosController::class, 'index'])->name('inicio');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/mostrar', [CursosController::class, 'show'])->name('mostrar');
Route::get('/crear', [CursosController::class, 'create'])->name('crear')->middleware('auth');
Route::post('/guardar', [CursosController::class, 'store'])->name('guardar')->middleware('auth');
Route::get('/editar/{curso}/edit', [CursosController::class, 'edit'])->name('editar')->middleware('auth');
Route::put('editar/{curso}', [CursosController::class, 'update'])->name('actualizar')->middleware('auth');
Route::get('/eliminar/{curso}', [CursosController::class, 'destroy'])->name('eliminar')->middleware('auth');

Route::get('perfil', function () {return view('user.editUser');})->name('perfil')->middleware('auth');
Route::put('updateProfile/{user}', [HomeController::class, 'update'])->name('updateProfile')->middleware('auth');
Route::put('changePassword/{user}', [HomeController::class, 'restartPassword'])->name('changePassword')->middleware('auth');




// Route::get('/mostrar', function () {
//     return view('cursos.mostrar');
// })->name('mostrar');

