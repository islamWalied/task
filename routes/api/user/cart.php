<?php


use Illuminate\Support\Facades\Route;







Route::middleware(['auth.type:user','auth:sanctum'])->group(function (){
    Route::post('/carts/{id}',[\App\Http\Controllers\CartController::class,'store']);
    Route::delete('/carts/{id}',[\App\Http\Controllers\CartController::class,'destroy']);
    Route::get('/carts',[\App\Http\Controllers\CartController::class,'index']);
    Route::patch('/carts/{id}/increment',[\App\Http\Controllers\CartController::class,'increment']);
    Route::patch('/carts/{id}/decrement',[\App\Http\Controllers\CartController::class,'decrement']);
});



