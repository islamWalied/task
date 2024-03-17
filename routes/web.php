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

Route::post('/login',[\App\Http\Controllers\AuthController::class,'login_admin'])->name('login');

Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout_admin'])->name('logout_admin');

Route::middleware(['auth.type:admin'])->group(function(){
    Route::get('/admin',[\App\Http\Controllers\AdminController::class,'index'])->name('admin');
    Route::get('/orders',[\App\Http\Controllers\OrderController::class,'index'])->name('orders');
});
