<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderRegisterController;
use App\Http\Controllers\TariffTypeController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tariff', [TariffTypeController::class, 'index']);
Route::post('save_order', [OrderRegisterController::class, 'registerOrder']);

//Route::post('save_client', [ClientController::class, 'save']);
//Route::put('update_client', [ClientController::class, 'update']);
//Route::post('save_order', [OrderController::class, 'save']);
//Route::put('update_order', [ClientController::class, 'update']);
