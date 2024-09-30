<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'AuthLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'requester'], function () {
Route::get('home', [PagesController::class, 'home'])->name('home');
Route::get('pedidos', [PagesController::class, 'myOrders'])->name('myOrders');
});
Route::group(['middleware' => 'approver'], function () {
Route::get('gestao', [PagesController::class, 'orders'])->name('orders');
});

