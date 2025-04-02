<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

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

// Route::get('/', function () {return view('characters/local');});

Route::get('/characters/api', [CharacterController::class, 'fetchApiData'])->name('characters.api');
Route::get('/characters/store', [CharacterController::class, 'storeApiData'])->name('characters.store');
Route::post('/characters/store', [CharacterController::class, 'storeApiData'])->name('characters.store');
Route::get('/characters/local', [CharacterController::class, 'indexLocal'])->name('characters.local');
// Route::get('/characters/index', [CharacterController::class, 'indexLocal'])->name('characters.local');
Route::get('/characters/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');

