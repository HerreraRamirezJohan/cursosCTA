<?php

use App\Http\Controllers\CursosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::get('/crear', [CursosController::class, 'create'])->name('crear');
Route::post('/guardar', [CursosController::class, 'store'])->name('guardar');

Route::get('/editar/{curso}/edit', [CursosController::class, 'edit'])->name('editar');
Route::put('editar/{curso}', [CursosController::class, 'update'])->name('actualizar');





// Route::get('/mostrar', function () {
//     return view('cursos.mostrar');
// })->name('mostrar');

