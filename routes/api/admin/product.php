<?php


use Illuminate\Support\Facades\Route;







Route::middleware(['auth.type:admin','auth:sanctum'])->prefix('admin')->group(function (){
    Route::apiResource('/products',\App\Http\Controllers\ProductController::class);
});



