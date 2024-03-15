<?php


use Illuminate\Support\Facades\Route;







Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('/carts',\App\Http\Controllers\CartController::class);
//    Route::post('/carts',[\App\Http\Controllers\CartController::class,'store']);
});



