<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PrefixsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AccountsMoneyController;
use App\Http\Controllers\AccountMoneyTypeController;
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

Route::get('/accounts', [AccountsController::class, "getAll"]);
Route::post('/account/add', [AccountsController::class, "add"]);
Route::delete('/account/del/{id}', [AccountsController::class, "del"]);
Route::get('/account/{id}', [AccountsController::class, "get"]);
Route::put('/account/edit/{id}', [AccountsController::class, "edit"]);

Route::get('/accounts_money', [AccountsMoneyController::class, "getAll"]);
Route::post('/account_money/add', [AccountsMoneyController::class, "add"]);
Route::delete('/account_money/del/{id}', [AccountsMoneyController::class, "del"]);
Route::get('/account_money/{id}', [AccountsMoneyController::class, "get"]);
Route::put('/account_money/edit/{id}', [AccountsMoneyController::class, "edit"]);

Route::get('/accounts_money_type', [AccountMoneyTypeController::class, "getAll"]);