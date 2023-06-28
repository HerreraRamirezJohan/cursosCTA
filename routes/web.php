<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\AgendaController;

use App\Http\Controllers\CursosController;
use App\Http\Controllers\HorariosNewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* Obtenemos el metodo que creamos para actualizar el perfil del usuario */
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ImportExcel;

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
Route::get('/eliminar_horario/{id_curso}/{dia}', [CursosController::class, 'destroyHorario'])->name('eliminarHorario')->middleware('auth');

Route::get('perfil', function () {return view('user.editUser');})->name('perfil')->middleware('auth');

Route::get('importExcel', [ImportExcel::class, 'index'])->name('importExcel')->middleware('auth');
Route::post('process-api', [ImportExcel::class, 'store'])->name('process.api');

Route::put('updateProfile/{user}', [HomeController::class, 'update'])->name('updateProfile')->middleware('auth');
Route::put('changePassword/{user}', [HomeController::class, 'restartPassword'])->name('changePassword')->middleware('auth');


Route::get('/importar', function(){return view('cursos.import');})->name('indexImport')->middleware('auth');
Route::post('/importando', [HorariosNewController::class, 'importSeeder'])->name('importSeeder')->middleware('auth');

// Route::resource('areas', AreasController::class);
Route::get('/areas', [AreasController::class, 'index'])->name('areas');

Route::post('/mostrarAreas', [AreasController::class, 'show'])->name('mostrarAreas');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');


// Route::get('/areas', [AreasController::class, 'index'])->name('areas')->middleware('auth');

