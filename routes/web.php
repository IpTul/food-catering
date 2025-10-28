<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredCustomerController;
use App\Http\Controllers\Auth\LoginCustomerController;

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\RecipePageController;
use App\Http\Controllers\Api\RecipeController;

use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/catering', [RecipePageController::class, 'index'])->name('catering.catering');
Route::get('/catering/{recipe}', [RecipePageController::class, 'show'])->name('catering.show');
Route::get('/catering/buy/{recipe}', [RecipePageController::class, 'buy'])->name('catering.buy')->middleware('auth:customer');

Route::get('/about', [AboutPageController::class, 'index'])->name('about');

Route::get('/login', [LoginCustomerController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginCustomerController::class, 'login'])->name('login.attempt');

Route::get('/register', [RegisteredCustomerController::class, 'create'])->name('register.show');
Route::post('/register', [RegisteredCustomerController::class, 'store'])->name('register.store');

Route::post('/logout', [LoginCustomerController::class, 'logout'])->name('logout');

Route::post('/midtrans/token', [PaymentController::class, 'getSnapToken'])->name('midtrans.token');
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('midtrans.callback');
