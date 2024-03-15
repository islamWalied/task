<?php


use Illuminate\Support\Facades\Route;







Route::middleware(['auth:sanctum'])->group(function (){
    Route::apiResource('/orders',\App\Http\Controllers\OrderController::class);
});



