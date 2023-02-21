<?php

use App\Http\Controllers\API\JsonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/addJson', [JsonController::class, 'addJson'])->name('addJsonAPI');

Route::any('/updateJson', [JsonController::class, 'updateJson'])->name('updateJsonAPI');
