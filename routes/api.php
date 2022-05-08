<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\articleController;
use Illuminate\Http\Request;


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

Route::get('/article/display',[articleController::class,'index']);
Route::post('/article/store',[articleController::class,'store']);
Route::delete('/article/delete/{id}',[articleController::class,'destroy']);
