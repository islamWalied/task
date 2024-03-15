<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('/');

Route::post('/',[\App\Http\Controllers\AuthController::class,'login_admin'])->name('login');

Route::middleware(['auth:sanctum','auth.type:admin'])->group(function(){
    Route::get('admin',[\App\Http\Controllers\AdminController::class,'index']);
    Route::get('orders',[\App\Http\Controllers\OrderController::class,'index'])->name('orders');
});
