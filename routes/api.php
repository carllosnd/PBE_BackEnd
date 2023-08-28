<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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

Route::get('/coba',function (){
    return response()->json([
        'message' => 'Hello World, ini adalah Back-End'
    ],200);
});

Route::group(['prefix' => 'publishers'],function () {
   Route::get('/',[\App\Http\Controllers\PublisherController::class, 'getAll']);
   Route::get('/{id}',[\App\Http\Controllers\PublisherController::class, 'getById']);
   Route::post('/',[\App\Http\Controllers\PublisherController::class, 'create']);
   Route::put('/',[\App\Http\Controllers\PublisherController::class, 'update']);
   Route::delete('/',[\App\Http\Controllers\PublisherController::class, 'delete']);
});
