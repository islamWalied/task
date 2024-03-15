<?php


use Illuminate\Support\Facades\Route;







Route::middleware('auth.admin')->prefix('admin')->group(function (){
    Route::apiResource('/products',\App\Http\Controllers\ProductController::class);
});



