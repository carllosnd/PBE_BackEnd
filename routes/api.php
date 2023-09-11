<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
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

Route::post('/user/login',[AuthController::class, 'verify']);

Route::group(['prefix' => 'publishers', 'middleware' => 'pbe.auth'],function () {
   Route::get('/',[PublisherController::class, 'getAll']);
    Route::get('/{id}',[PublisherController::class, 'getById']);
    Route::get('/{id}/books',[PublisherController::class, 'getBooksByIdPublisher']);
    Route::post('/',[PublisherController::class, 'create']);
    Route::put('/',[PublisherController::class, 'update']);
   Route::delete('/',[PublisherController::class, 'delete']);
});

Route::group(['prefix'=>'books'],function () {
    Route::get('/',[BookController::class, 'getAll']);
    Route::get('/{id}',[BookController::class, 'getById']);
    Route::post('/',[BookController::class, 'create']);
    Route::put('/',[BookController::class, 'update']);
    Route::delete('/',[BookController::class, 'delete']);
});
