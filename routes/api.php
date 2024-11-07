<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CommentController;
use App\Models\User;

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

Route::post('/registers',[AuthUserController::class,'registers']);
Route::post('/loginus',[AuthUserController::class,'loginus']);

Route::group(['middleware'=>['auth:sanctum']],function(){

    
Route::resource("/posts",PostController::class);



Route::post('/logout',[AuthUserController::class,'logout']);

Route::resource("/comment",PostController::class);
});


