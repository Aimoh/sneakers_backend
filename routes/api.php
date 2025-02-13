<?php

use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\SessionController;
use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('items', ItemController::class);
    Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1\Auth'], function () {
    Route::post('auth/register', RegisterController::class);
    Route::post('auth/login', SessionController::class);
    Route::post('auth/logout', LogoutController::class)->middleware('auth:sanctum');
});
