<?php

use App\Http\Controllers\NotaNutricionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('director/inicio', function () {
    return view('director.inicio');
})->name('director.inicio');

Route::get('alumno/inicio', function () {
    return view('alumno.inicio');
})->name('alumno.inicio');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/nota-nutricion/crear', [NotaNutricionController::class,'crear']);
Route::patch('/nota-nutricion/actualizar', [NotaNutricionController::class,'actualizar']);

require __DIR__ . '/auth.php';
