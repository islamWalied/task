<?php


use Illuminate\Support\Facades\Route;







Route::middleware('admin')->prefix('admin')->group(function (){
    Route::get('/products',[\App\Http\Controllers\ProductController::class,'index']);
});



