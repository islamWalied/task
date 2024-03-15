<?php


use Illuminate\Support\Facades\Route;








Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
});
