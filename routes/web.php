<?php

use App\Http\Controllers\JsonController;
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
});

Route::prefix('json')->group(function () {
    Route::get('/', [JsonController::class, 'index'])->name('indexJson');
    Route::post('/add', [JsonController::class, 'addJson'])->name('addJson');
    Route::post('/update', [JsonController::class, 'updateJson'])->name('updateJson');
});
