<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalificacionController;

Route::get('/', function () {
    return redirect()->route('calificaciones.index');
});

Route::resource('calificaciones', CalificacionController::class);
Route::get('/estadisticas', [CalificacionController::class, 'estadisticas'])->name('calificaciones.estadisticas');

//pair programming
Route::get('/calificaciones/buscar', [CalificacionController::class, 'buscar'])->name('calificaciones.buscar');
