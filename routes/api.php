<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PrefixsController;

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

Route::get('/users', [UsersController::class, "getAll"]);
Route::post('/user/add', [UsersController::class, "add"]);
Route::delete('/user/del/{id}', [UsersController::class, "del"]);
Route::get('/user/{id}', [UsersController::class, "get"]);
Route::put('/user/edit/{id}', [UsersController::class, "edit"]);

Route::get('/prefixs', [PrefixsController::class, "getAll"]);
