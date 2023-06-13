<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SongController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('songs', [SongController::class, 'index']);
Route::post('songs', [SongController::class, 'store']);
Route::get('songs/{id}', [SongController::class, 'show']);
Route::get('songs/{id}/edit', [SongController::class, 'edit']);
Route::put('songs/{id}/edit', [SongController::class, 'update']);
Route::delete('songs/{id}/delete', [SongController::class, 'destroy']);